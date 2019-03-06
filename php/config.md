# How to write and access config values in php

## Config as array 

```php
// config.php
<?php
return [
    'database' => [
        'host' => 'localhost',
        'name' => 'somedb',
        'user' => 'someuser',
        'pass' => 'somepass'
    ],
    'other-stuff' => ...
]
?>
```

### Accessing config values
```php
<?php
$config = include('path/config.php');
echo $config['database']['host']; // 'localhost'
?>
```

#### In class 
Since we can't include code into a class (because it's in a different namespace) we have to do a workaround 
with the `constructor`.
https://stackoverflow.com/questions/1957732/can-i-include-code-into-a-php-class

#### In static methods
Therefore the value has to be imported from the other namespace into the class
 ```php
 <?php
$config = include('path/config.php');
Bill::print();
?>
```

```php
// Bill.php
<?php

class Bill
{
	private static $config = false;
	public static function print() {
	// Import the var $config_id from the other namespace to the class
	self::$config = $GLOBALS['config'];
        echo $config['database']['host'];
    }
}
?>
 ```
Advantage: You can change config values after including it and before it gets used
for e.g. if you have a `customer_id` and it takes the id from the session but if you are logged in as administrator 
you could change the `customer_id` manually. Also expressions allowed. 
Disadvantages: You have to write `self::$config = $GLOBALS['config']` in every function and the class has to have a 
`static $config` variable declared 

## Config as class 
For this method the config file is not an array but a class and can be written like this
 ```php
// Config.php
 
<?php
class Config
{
 	//Database
 	const host = 'localhost';
 	const username = 'root';
 	const password = '';
}
?>
```

### Accessing config values

```php
<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/Config.php';
echo Config::host;
Bill::print();
?>
```
**In static methods**
```php
// Bill.php
<?php 

class Bill
{
    public static function print() {
        echo Config::host;
    }
}
?>
```

Advantages: This is the simplest way I found so far and it can be accessed everywhere in the same way as long as it's not an expression   
Disadvantages: Expressions are not allowed (`const host = Class::getHost()`) and a `const` variable cannot be changed so as soon as it is defined in the `config class` it cannot be modified 

----
#### Sources
https://stackoverflow.com/questions/4489134/php-class-global-variable-as-property-in-class  
https://stackoverflow.com/questions/1957732/can-i-include-code-into-a-php-class   
https://www.abeautifulsite.net/a-better-way-to-write-config-files-in-php  
Joel Kuder
