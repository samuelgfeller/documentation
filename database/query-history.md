# How to monitor executed queries

### Activate general query log 
```sql
SET GLOBAL general_log=1;
```
More infos here: https://mariadb.com/kb/en/general-query-log/

### Locate query log file
On XAMPP it is generally located under `C:\xampp\mysql\data\YOUR-PC-NAME.log`  

Here is how to find it with a query:
```sql
SHOW VARIABLES LIKE '%log_file%';
```
Source: https://stackoverflow.com/a/3638144/9013718

### Disable general query log
Don't forget to disable it afterwards otherwise the file may grow quickly in size.
```sql
SET GLOBAL general_log=0;
```
