### Error Callable does not exist  
**Problem:**   
*Error: Callable `App\Controllers\Locations\MigrateContactAction` does not exist*   
Appears when calling an invokable class directly in the router.  
**Solution:**     
```
composer dump-autoload -o
```

### Container with slim 4:
#### Report 1 & 2
**Problem:** there's no DI-Bridge in my case. Do you know if that's going to be supported for v4 anytime soon?  
**Answer:** you don’t need DI bridge. You can use any PSR-11 container implementation you want with Slim 4.  
Go look at https://github.com/slimphp/Slim-Skeleton it uses PHP-DI with Slim   
**[Source](https://github.com/slimphp/Slim/issues/2770#issuecomment-517960368)** 
**Question:** Support missing?:   
**Answer:** Bridge not yet supported, see PHP-DI/Slim-Bridge#47  
However you can put PHP-DI in Slim manually thanks to PSR-11 (you won't get any feature of the bridge though). But maybe the PR I linked to can help you."
**Source** https://github.com/PHP-DI/PHP-DI/issues/680  

**Solution**  
Bridge not needed anymore.    
**Require  `"php-di/php-di": "^6.0" `**

