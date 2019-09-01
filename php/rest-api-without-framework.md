# REST API without Framework

Best practices: https://blog.mwaysolutions.com/2014/06/05/10-best-practices-for-better-restful-api/

Redirect all requests to the `/public` folder
```apacheconfig
# .htaccess

RewriteEngine on
RewriteRule ^$ public/ [L]
RewriteRule (.*) public/$1 [L]
```

Send requests to `public/index.php`
```apacheconfig
# public/.htaccess

RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [QSA,L]
```

Transform URL and keep only the part after the domain
```php
// public/index.php

$path = parse_url($_SERVER['REQUEST_URI'])['path'];
$scriptName = dirname($_SERVER['SCRIPT_NAME']);
$scriptName = dirname($scriptName);
$len = strlen($scriptName);

if (($len > 0 && $scriptName !== '/') || $scriptName !== "\\") {
    $path = substr($path, $len);

}

// If URL is 'https://your.domain.com/locations' the $path will be 'locations'
require_once $_SERVER['DOCUMENT_ROOT'] . '/ajax_controller.php';

header('HTTP/1.0 404 Not Found');
echo '404 Not Found';
```

Interpret the URL in the controller
```php
if ($path === 'locations') {
	var_dump($path);
	/* If the URL is location/id for e.g. 'locations/21' the request should also get interpreted for
	read or update so the string could be exploaded and check if there is a value in $arr[1] and if so is it a number
	(ctype_digit($string)) if yes we can assume that its a number and have the id value */
	switch ($_SERVER['REQUEST_METHOD']) {
		// Create
		case 'POST':
			
			break;
		// Read
		case 'GET':
			if (/* has not an id */) {
				// return all locations
				echo json_encode(LocationDAO::getAllLocations());
                break;
		    }
			/*has id*/
			echo json_encode(LocationDAO::getLocation(/*id*/));
			break;
		// Update
		case 'PUT':
			if (/* has an id */) {
				// return all locations
				// I have no idea how to use put and get data yet https://stackoverflow.com/questions/27941207/http-protocols-put-and-delete-and-their-usage-in-php
				LocationDAO::getAllLocations(/* new data */);
				break;
			}
			break;
		// Delete
		case 'DELETE':
			if (/* has an id */) {
				LocationDAO::deleteLocation(/* id */);
				break;
			}
		default:
			// handle error 
			break;
	}
	exit;
}
```


