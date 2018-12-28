# Get values for SQL input

## Description
This function transforms the given values into SQL import ready data. Basically it means that the string are wrapped with an extra double quote while the integers and booleans don't get modified.
The "new" values are put in an array. The keys of the associative array become colums and get stored in the $cols array.  
The values must have a type so take care that the type of the value which is expected to be an integer really an int is. You could [cast](http://php.net/manual/en/language.types.type-juggling.php) it in each setter of the class to be sure.

```php
function getImportColAndValues($data) {
   $cols = [];
   $values = [];
   foreach ($data as $key => $value) {
      if (!empty($value)) {
         if (is_string($value)) {
            $values[] = '"' . $value . '"';
            $cols[] = $key;
         } else if (is_bool($value) || is_int($value)) {
            $values[] = $value;
            $cols[] = $key;
         }
      }
   }
   return [
      'cols' => $cols,
      'values' => $values
   ];
}
```
## Parameter
The data which gets processed.
Expected is an associative array where the keys are the columns of the db table and the values the insert-values
```php
$data
```
## Return values
Returns a two dimensional array with the colums and values.

## Examples / Use case
```php
<?php
// Filling the array
$contact = [
    'id' => 2,    
    'name' => 'John Smith',
    'email' => 'john.smith@gmail.com'
];


// Getting the column and insert values
$colval = getImportColAndValues($contact);


// Prepare the insert query
$insertContact = 'insert into contact (' . implode(',', $colval['cols']) . ') values (' . implode(',', $colval['values']) . ');';
echo $insertContact;
?>
```
The above example will output:
```sql
insert into contact (id,name,email) values (2,"John Smith","john.smith@gmail.com");
```

# Note
I like to write it in a static Helper class
```php
public static function getImportColAndValues($data)
```

# Side note for me DON'T DO IT 
I wanted to do something to update an entry but I figured out that it was complete trash because if a value is turned into NULL it should get updated in the databse but the function above doesn't even store these values in the return array. 
I keep it just in case because I put work in it and maybe it can be useful in some case
```php
$data = [
    'nummer' => $artikel->getNummer(),
    'name' => $artikel->getName(),
    'kg_price' => $artikel->getKgPrice(),
    'stueck_gewicht' => $artikel->getStueckGewicht(),
    'gewicht_1' => $artikel->getGewicht1(),
    'gewicht_2' => $artikel->getGewicht2(),
    'gewicht_3' => $artikel->getGewicht3(),
    'stueckzahl_1' => $artikel->getStueckzahl1(),
    'stueckzahl_2' => $artikel->getStueckzahl2(),
    'stueckzahl_3' => $artikel->getStueckzahl3(),
];
$colsAndValues = Helper::getSQLColAndValues($data);
$updColsAndValsFormatted= [];
foreach ($colsAndValues['cols'] as $key => $col){
    $updColsAndValsFormatted[] = $col.' = '.$colsAndValues['values'][$key];
}
$query = 'UPDATE artikel SET '.implode(', ', $updColsAndValsFormatted).' WHERE id =' . $artikel->getId();
```
