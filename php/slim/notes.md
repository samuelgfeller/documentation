Dependency injection and many other useful stuff and good practices to create a slim app: https://odan.github.io/2019/03/18/creating-your-first-slim-framework-application-part-2.html  

> Use the prefix **get** to indicate that this method must return a value, otherwise throw an exception. If the select method can return an empty result set, the method name starts with **find** and doesn’t throws an exception.  
  
*Note for me if I want to work with transactions once:*
> Database transactions must be handled on a higher level (domain service) and not within a repository.
---
   
### Notes for me about DI
The `service` can be injected like follows into the constructor of the controller without having to be defined into the container -- why? -- 
```php
class UserController extends Controller {

    protected $userService;

    public function __construct(LoggerInterface $logger, UserService $userService) {
        parent::__construct($logger);
        $this->userService = $userService;
    }
}
```
   
   
Possible Architecture: https://jkphl.is/articles/clear-architecture-php/  
  
  


