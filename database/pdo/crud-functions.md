# Useful PDO crud functions in PHP

## Insert data with assoc Array
### Description
This function inserts data in the database using PDO prepared statements.

```php
/**
 * Insert data in database
 * 
 * @param string $table
 * @param array $data assoc array. Key has to be the table name and value its value
 * @return bool|string
 */
public static function insert($table, $data) {
    if ($conn = PdoConnection::instance()) {
        $query = 'INSERT INTO `' . $table . '` (`' . implode('`, `', array_keys($data)) . '`) 
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
$data = [  
    'name' => 'John Smith',
    'email' => 'john.smith@gmail.com',
    'age' => 47
];

insert('client',$data);
```


## Run query 
### Description
This function runs a query with PDO.

```php
/**
 * Run a query for example update or delete
 *
 * @param string $query
 * @param array $args
 * @return PDO|bool
 */
public static function run(string $query, array $args = []) {
    if ($conn = PdoConnection::instance()) {
        $stmt = $conn->prepare($query);
        $stmt->execute($args);
        return $conn;
    }
    return false;
}
```
### Parameter
The query to run
```php
$query
```
An array with the values
```php
$args
```

### Examples / Use case

```php
$query = 'UPDATE client SET deleted_at=now() WHERE id=?';
run($query, [$id]);
```

## Select and fetch multiple data
### Description
This function selects one or more data from a table and fetches it as an assoc array

```php
/**
 * Select multiple data from database and return them as an associative array
 *
 * @param string $query
 * @param array $args arguments (? in query)
 * @return array|bool
 */
public static function selectAndFetchAssocMultipleData(string $query, array $args = []) {
    if ($conn = PdoConnection::instance()) {
        $stmt = $conn->prepare($query);
        $stmt->execute($args);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return false;
}
```
### Parameter
The query to run
```php
$query
```
Array with the values
```php
$args
```

### Examples / Use case

```php
$query = 'SELECT * FROM bill WHERE date=?;';
$allData = selectAndFetchAssocMultipleData($query,[$date]);
```


## Select and fetch one single data
### Description
This function is able to select and fetch only one data from a table assoc array

```php
/**
 * Select single data from database and return it as an assoc array which is the value
 *
 * @param string $query
 * @param array $args
 * @return bool|mixed
 */
public static function selectAndFetchSingleData(string $query, array $args = []) {
    if ($conn = PdoConnection::instance()) {
        $stmt = $conn->prepare($query);
        $stmt->execute($args);
        return $stmt->fetch();
    }
    return false;
}
```
### Parameter
The query to run
```php
$query
```
Array with the values
```php
$args
```

### Examples / Use case

```php
$query = 'SELECT * FROM client WHERE id =?;';
$oneClientData = selectAndFetchSingleData($query, [$id]);
```

