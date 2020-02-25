# Time tracking with `hrtime`
`microtime` should not be used anymore. For time tracking of PHP scripts `hrtime` suits.

```php
$time=0;
$t = hrtime(true);
sleep(2);
var_dump((hrtime(true)-$t)/1e+9); // in nanoseconds to seconds
$time+=(hrtime(true)-$t)/1e+9;
echo $time;
```
