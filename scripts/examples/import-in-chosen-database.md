# Import dump into wanted database  
2 possibilities to import the dump in and the user can choose.

### Script
```shell script
#!/bin/bash

if [ $# -eq 1 ]; then
  backupfile=$1
else
  read -r -p "Enter the full path and name of the mysql backupfile: " backupfile
fi

if [ -f "$backupfile" ]; then
  echo 'Warning: the table have to exist and must be empty'
  echo "ge - Geneva database export"
  echo "ne - Neuchatel database export"
  read -r -p 'Branch office: ' branchoffice

  case $branchoffice in
  "ge")
    echo "[$(date '+%d/%m/%Y %H:%M:%S')] Importing into ge database..."
    mysql -hsql01.wmc.ch OASIS70_AXIOM_GE < "$backupfile"
    ;;
  "ne")
    echo "[$(date '+%d/%m/%Y %H:%M:%S')] Importing into ne database..."
    mysql -hsql01.wmc.ch OASIS70_AXIOM_NE < "$backupfile"
    ;;
  *)
    echo "String ne or ge is requested."
    # Exit script so that it doesn't continue
    exit 1
    ;;
  esac
  echo "[$(date '+%d/%m/%Y %H:%M:%S')] import done."
  echo 'Script end.'
else
  echo "File $backupfile does not exist."
fi

```
