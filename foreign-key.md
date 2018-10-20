# Add foreign key on existing table

```sql
ALTER TABLE katalog ADD FOREIGN KEY (`Sprache`) REFERENCES Sprache(`ID`);
```

***
Source: https://stackoverflow.com/a/21405245/9013718
