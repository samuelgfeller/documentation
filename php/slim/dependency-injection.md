# Dependency Injection in Slim 4

Example of how I implemented the injection of the different dependencies.   
It includes
* Settings with logger and db credentials 
* Definition of divers dependencies 
* Definition of repositories (which are the direct interaction with the database) in order that they can be injected
* Build of the app with the definitions in `index.php` 
* How Service is injected into a controller

I should mention that I use `php-di/php-di`
 
### Settings
With Logger and db credentials  
File: `app/settings.php`
```php
return function (ContainerBuilder $containerBuilder) {
    // Global Settings Object
    $containerBuilder->addDefinitions(['settings' => ['displayErrorDetails' => true,
        // Should be set to false in production
        'logger' => ['name' => 'merge-bs',
            'path' => isset($ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => Logger::DEBUG,],
        'db' => ['host' => 'localhost',
            'dbname' => 'timetable',
            'user' => 'root',
            'pass' => '',],],]);
};
```
### Dependencies
Diverse dependencies which can be injected via constructors. In this example Logger and PDO  
File: `app/dependencies.php`
```php
return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
        $settings = $c->get('settings');
        $loggerSettings = $settings['logger'];
        $logger = new Logger($loggerSettings['name']);

        $processor = new UidProcessor();
        $logger->pushProcessor($processor);

        $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
        $logger->pushHandler($handler);

        return $logger;
        },
        PDO::class => function (ContainerInterface $c) {
            $dbSettings = $c->get('settings')['db'];
            $dsn = 'mysql:host=' . $dbSettings['host'] . ';dbname=' . $dbSettings['dbname'];
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,];
            return new PDO($dsn, $dbSettings['user'], $dbSettings['pass'], $options);
        },

    ]);
};
```

### Repositories 
Repository injected with an instance of `PDO`  
File: `app/repositories.php`
```php
return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        UserRepositoryInterface::class => function (ContainerInterface $container) {
            $pdo = $container->get(PDO::class);
            return new UserRepository($pdo);
        },
    ]);
};
```

### Build app 
File: `public/index.php`

```php
// Instantiate PHP-DI ContainerBuilder
$containerBuilder = new ContainerBuilder();

// Set up settings
$settings = require __DIR__ . '/../app/settings.php';
$settings($containerBuilder);

// Set up dependencies
$dependencies = require __DIR__ . '/../app/dependencies.php';
$dependencies($containerBuilder);

// Set up repositories
$repositories = require __DIR__ . '/../app/repositories.php';
$repositories($containerBuilder);

// Build PHP-DI Container instance
$container = $containerBuilder->build();

// Set container to create App with on AppFactory
AppFactory::setContainer($container);
// Instantiate the app
$app = AppFactory::create();
```

### Service (business logic)
The `service` can be injected like follows into the constructor of the controller without having to be defined into the container   
-- why can this without definition but the repository has to be defined and manually injected with pdo? 
Please [contact](mailto:samuelgfeller@bluewin.ch) me I am confused on this. -- 
  
I removed the Logger injection which is used in the parent for this example  
File: `src/Application/Controllers/UserController`
```php
class UserController extends Controller {

    protected $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }
}
```

### Multiple instances of the same Class 

I had troubles to work with 2 database connections so I asked on StackOverflow and got a good Answer from Daniel Opitz: https://stackoverflow.com/questions/57758020/how-to-set-up-and-inject-multiple-pdo-database-connections-in-slim-4/57769575#57769575 

---
### Documentation / Source 
Slim doc: http://www.slimframework.com/docs/v4/concepts/di.html  
Slim skeleton: https://github.com/slimphp/Slim-Skeleton   
Article from Daniel Opitz: https://odan.github.io/2019/03/18/creating-your-first-slim-framework-application-part-2.html  
