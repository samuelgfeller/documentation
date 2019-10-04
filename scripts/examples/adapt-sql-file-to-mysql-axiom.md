# Adapt SQL file to be valid for axiom database

The dump is from a MSSQL database and throws multiple errors in the import. This script adapts and removes the illegal strings and characters. The strings to remove are slightly different in the neuchatel and geneva branch office so it prompts the user to type in which one is intended. 

### What the script basically does
![Search and replace visualisation](https://i.imgur.com/HpzUWiP.png)

### Start script
```shell script
./sql_convert_axiom.sh
```

### Script

```shell script
#!/bin/bash

if [ $# -eq 1 ]; then
  backupfile=$1
else
  read -r -p "Enter the full path and name of the backupfile: " backupfile
fi

if [ -f "$backupfile" ]; then
  echo "ge - Geneva database export"
  echo "ne - Neuchatel database export"
  read -r -p 'Branch office: ' branchoffice

  case $branchoffice in
  "ge")
    echo 'Executing sed commands for ge...'
    sed -i '/Insert into OASIS70_AXIOM_GE.SYS_EXPORT_SCHEMA/d' "$backupfile"
    echo "Removed lines which contained EXPORT_SCHEMA"
    ;;
  "ne")
    echo 'Executing sed commands for ne...'
    sed -i '/Insert into OASIS70_AXIOM_NE.SYS_EXPORT_SCHEMA/d' "$backupfile"
    echo "Removed lines which contained EXPORT_SCHEMA"

    sed -i '/AS_DICO_TITRES/d' "$backupfile"
    echo "Removed lines which contained AS_DICO_TITRES"

    sed -i sed "s/to_date('04.04.18','DD.MM.RR')/'04.04.18\'/g" "$backupfile"
    echo "Replaced to_date('04.04.18','DD.MM.RR')	with '04.04.18'"
    ;;
  *)
    echo "String ne or ge is requested."
    # Exit script so that it doesn't continue
    exit 1
    ;;
  esac

  sed -i 's/REM INSERTING/-- REM INSERTING/g' "$backupfile"
  echo "Commented out REM INSERTING"

  sed -i 's/SET DEFINE OFF/-- SET DEFINE OFF/g' "$backupfile"
  echo "Commented out SET DEFINE OFF"

  sed -i "s/\\\'/\'/g" "$backupfile"
  echo "Replaced \' with '"

  sed -i 's/\"Key\",\"ApplicationUser\",\"Data\"/\`Key\`,\`ApplicationUser\`,\`Data\`/g' "$backupfile"
  echo "Replaced \"Key\",\"ApplicationUser\",\"Data\" with \`Key\`,\`ApplicationUser\`,\`Data\`	"

  echo 'Script end.'
else
  echo "File $backupfile does not exist."
fi

```
