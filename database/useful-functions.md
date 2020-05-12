# Useful MySQL functions

### Turn foreign key check off

```sql
SET FOREIGN_KEY_CHECKS=0;
SET FOREIGN_KEY_CHECKS=1;
```

### Add foreign key on existing table

```sql
ALTER TABLE katalog ADD FOREIGN KEY (`Sprache`) REFERENCES Sprache(`ID`);
```

Source: https://stackoverflow.com/a/21405245/9013718

### Find tables that reference particular table.column 
```sql
USE information_schema;

SELECT TABLE_NAME
FROM
  KEY_COLUMN_USAGE
WHERE
  REFERENCED_TABLE_NAME = 'policy_branch_type'
  AND REFERENCED_COLUMN_NAME = 'id'
  AND TABLE_SCHEMA = 'bs_biz_axiom';
  ```
Source: https://stackoverflow.com/a/1133461/9013718
