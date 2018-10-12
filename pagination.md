### Variable description
`$pageNr`: Pagination page number
`$start_from`: From where the data should be taken
`$record_per_page`: Maximum records per page and limit in the sql query.

If `$pageNr` is 1 the sql query should take the data from 0 to the amount of records on one page.
But if `$pageNr` is more than 1 the number where it should start (`$start_from`) is the page number minus one times the records per page.
It means that if the page number is 3 that makes: `$start_from = ( 3 - 1 ) * 13` so it starts from 26 so on page 3 it starts to take 
the data from 26 with a limit of the `$record_per_page`.

### Example
```php
$pageNr = 1;
$record_per_page=13;
// Set where it should start to take the data
$start_from = ($pageNr - 1) * $record_per_page;
$total_records = Client::all()['total_records']; //gets the total of records(Ort::all gives all records or clients in an array)
$orte = Client::allPagination($start_from,$record_per_page);

<?php
//ceil rounds up (5.1 = 6)
$total_pages = ceil($total_records / $record_per_page);
$start_loop = 1;
?>

<nav id="paginationNav" aria-label="Page navigation">
    <div class="pagination">
        <?php
        if ($page > 1) {
            echo "<a href='" . $url . "/1'><<</a>";
            echo "<a href='" . $url . "/" . ($page - 1) . "'><</a>";
        }
        for ($i = 1/*$start_loop*/; $i <= $total_pages; $i++) {
            $class = $i == $page ? 'active' : '';
            echo "<a class='".$class."' href='" . $url . "/" . $i . "'>" . $i . "</a>";
        }
        if ($page < $total_pages) {
            echo "<a href='" . $url . "/" . ($page + 1) . "'>></a>";
            echo "<a href='" . $url . "/" . $total_pages . "'>>></a>";
        } ?>

    </div>
</nav>
```
