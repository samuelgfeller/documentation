# Port forwarding for noobs (like me)

## Functionning
To my current understanding, a program (like Putty or a console with ssh -L) will "bind" a specific server connection (so the remote host and port) to a local port meaning through this port (and localhost as hostname) `127.0.0.1:portnr`, the remote host can be accessed. 

## How to setup with Putty

### Bind remote database to local port 
The SQL Server `sqlserver.domain.ch` can be accessed with an SSH tunnel to `server.domain.ch`.   
Now let's assume we want to make a connection to this database from the code, it would be hard (even if possible) to make an SSH tunnel there. A simple option is to use 
[Putty](https://putty.org). 

#### Initiate connection to server
**Host and port**  
<img width="500" alt="Add hostname" src="https://i.imgur.com/s5EV5ZW.png">  
**Username**   
<img width="500" alt="Username" src="https://i.imgur.com/P49aV0i.png">   
**Private key**   
<img width="500" alt="Private key" src="https://i.imgur.com/3Md0ELd.png">   
**Under SSH you might want to check "Don't start a shell or command at all".** An open shell is useless as we are interested in the port forwarding from the background  
<img width="500" alt="Don't start a shell or command at all" src="https://i.imgur.com/IcbTOkn.png">   

#### Port forwarding   

<img width="500" alt="Forwarding" src="https://i.imgur.com/d9G8EPD.png">     

**Source port:** Local port that will point to destination address and port (e.g. 3308)  

**Destination:** `host:port` remote sql server host and its port number (often default 3306 for MySql)  

After clicking on "Add" and then opening the putty connection, the forwarding should be in place.

#### Result  
To connect to this database, all one has to do is a direct (TCP/IP) connection with 127.0.0.1 as host and the setup portnumber:  
**HeidiSQL connection**  
<img width="500" alt="Heidisql connection" src="https://i.imgur.com/QHmFkwF.png">    
**PHP Connection**
```php
$config = [
'host' => '127.0.0.1',
'database' => 'database',
'username' => 'username',
'password' => 'password',
'port' => 3308, // <-- Relevant Port
];

$dsn = 'mysql:host=' . $config['host'] . ';port=' . $config['port'] . ';dbname=' . $config['database'].';';
$options = [/* ... */];
$connection = new PDO($dsn, $config['username'], $config['password'], $options);
```

At the same time a local MySQL db can be running and accessed with the only difference beside the obvious database, username and password being the port number. 
It will determine to which server it connects to.


