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

### Delete double entries in a table
```sql
UPDATE
 `premium_invoice` AS `a`,
 `premium_invoice` AS `b`
 
SET a.deleted_at= "2018-08-23"
WHERE
 -- IMPORTANT: Ensures one version remains
 -- Change "ID" to your unique column's name
 `a`.`ID` < `b`.`ID`
-- Any duplicates you want to check for
 AND `a`.`policy_id` <=> `b`.`policy_id`
 AND `a`.`date_from` <=> `b`.`date_from`
 AND `a`.`date_to` <=> `b`.`date_to`
 AND `a`.`amount` <=> `b`.`amount`
 AND `a`.`courtage_amount` <=> `b`.`courtage_amount` 
 and a.deleted_at is null
 and b.deleted_at is null
 ;
```

Source: https://stackoverflow.com/a/25206828/9013718
