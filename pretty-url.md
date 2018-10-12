# PHP Pretty URL

## Apache forwarding
Read this article first: https://github.com/samuelgfeller/documentation/blob/master/virtual-host.md
### .htaccess  

Create `.htaccess` file at the root of the project and add the following to redirect to the `public/` folder
```
RewriteEngine on
RewriteRule ^$ public/ [L]
RewriteRule (.*) public/$1 [L]
```
### public/.htaccess  

In the public folder you can add another .htaccess file to redirect to the Front-Controller (`index.php`)
It could work without this because `index` is usually default if no file is specified in apache (`httpd.conf`) 
```
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [QSA,L]
```
### public/index.php  

The Front-Controller gets the url and gives the path  
The function `baseurl` and `hosturl` are optional but could be useful
```php
function baseurl($path = '', $full = false) {
	$scriptName = $_SERVER['SCRIPT_NAME'];
	$baseUri = dirname(dirname($scriptName));
	$result = str_replace('\\', '/', $baseUri) . $path;
	$result = str_replace('//', '/', $result);
	if ($full === true) {
		$result = hosturl() . $result;
	}
	return $result;
}
function hosturl(){
	$server = $_SERVER;
	$host = $server['SERVER_NAME'];
	$port = $server['SERVER_PORT'];
	$result = (isset($server['HTTPS']) && $server['HTTPS'] != "off") ? "https://" : "http://";
	$result .= ($port == '80' || $port == '443') ? $host : $host . ":" . $port;
	return $result;
}
//
// Get the URI path
//
$path = parse_url($_SERVER['REQUEST_URI'])['path'];
$scriptName = dirname($_SERVER['SCRIPT_NAME']);
$scriptName = dirname($scriptName);
$len = strlen($scriptName);
if (($len > 0 && $scriptName !== '/') || $scriptName !== "\\") {
	$path = substr($path, $len);
}
//var_dump($path);
require_once __DIR__."/../ajax_controller.php";
require_once __DIR__."/../controller.php";
//require_once __DIR__."/../templates/base.html.php";
header("HTTP/1.0 404 Not Found");
echo '404 Not Found';
```
### ajax_controller.php / controller.php
The `index.php` calls the ajax_controller first and then the controller. The reason is that the controller.php includes the base.html.php and on ajax request the site structure is not wanted.  
**ajax_controller:**
```php
<?php
if ($path == '') {
	require_once __DIR__ . '/public/templates/home.html.php';
	exit;
}
if ($path == 'contacts') {
        require_once __DIR__ . 'entity/Contact.php';
        $contacts = Contact::all();
	require_once __DIR__ . '/public/templates/contacts.html.php';
	exit;
}
```
**controller.php:**
```php
<?php
require_once __DIR__ . '/public/base.html.php';
if ($path == 'contact/del') {
	require_once 'entity/Contact.php';
	Contact::del($_POST['id']);
	exit;
}
if ($path == 'contact/find') {
       require_once __DIR__ . 'entity/Contact.php';
       $contact = Contact::find($_POST['id']);
       echo json_encode($contact);
       exit;
}	
```
### Loading ressources
Put the js and css files in the `public/` folder
And now on the `base.html.php` add
```html
    <base href="<?php echo baseurl('/', true) ?>">
```
Now link the ressources like that:
```html
<head>
    <base href="<?php echo baseurl('/', true) ?>">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <script src="main.js"></script>
</body>
```
***
Source: https://github.com/odan/glossar/blob/master/pretty-url.md
