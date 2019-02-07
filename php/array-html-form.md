## Passing dynamically created HTML Form values and use them

**Client**
```html
<form action="success" method="post">
<?php foreach ($values as $value) { ?>
	<input type="text" name="inputName[]">
	<input type="text" name="otherName[]">
<?php } ?>
<input type="submit" value="Bestellen">
</form>
```
**Server**
```php
for ($i = 0, $iMax = count($_POST['inputName'); $i < $iMax; $i++) {
	$valuesArr[] = [
 	'value1' => $_POST['inputName'][$i],
 	'value2' => $_POST['otherName'][$i],
 	];
}
```
