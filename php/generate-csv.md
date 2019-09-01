# Generate and download CSV

### Functions
Create CSV
```php
public static function createCsv($array) {
    if (count($array) > 0) {
    	ob_start();
    	$df = fopen("php://output", 'w');
    	fputcsv($df, array_keys(reset($array)));
    	foreach ($array as $row) {
    		fputcsv($df, $row);
    	}
    	fclose($df);
    	return ob_get_clean();
    }
    return null;
}
```
Set Headers / Remove caching
```php
public static function sendDownloadHeaders($filename) {
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");
    
    // force download
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    
    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");
}
```

### Usecase with ajax
Javascript / JQuery
```js
$("#migrateBtnFile").click(function () {
    $('#wait-animation').show();
    document.location.href = 'file/migrate';
    $('#wait-animation').hide();
});
```
Server
```php
sendDownloadHeaders('test.csv');
$csv = createCsv($fm_values);
echo $csv;
die;
```


----

### Source
https://stackoverflow.com/questions/4249432/export-to-csv-via-php
https://stackoverflow.com/questions/3346072/download-csv-file-using-ajax


