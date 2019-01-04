# Useful PDO crud functions in PHP

## Insert data with assoc Array
### Description
This function inserts data in the database using PDO prepared statements.

```php
public static function insert($table, $data) {
    if ($conn = PdoConnection::instance()) {
        $query = 'INSERT INTO ' . $table . ' (' . implode(', ', array_keys($data)) . ') 
        VALUES (:' . implode(', :', array_keys($data)) . ');';
        $stmt = $conn->prepare($query);
        $stmt->execute($data);
        return $conn->lastInsertId();
    }
    return false;
}
```
### Parameter
The name of the target table
```php
$table
```
An associative array with as key the name of the column and as value the insert value
```php
$data
```

### Examples / Use case

```php
<?php 

$data = [  
    'name' => 'John Smith',
    'email' => 'john.smith@gmail.com'
    'age' => 47
];

DataManagement::insert('client',$data);
```
