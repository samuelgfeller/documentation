## Update PHP or MySql

1. Download latest xampp installer https://www.apachefriends.org/download.html
2. Install xampp to a new path e.g. "c:\xampp8.3"
3. Rename the `php` folder in the `xampp` folder
4. Copy the `php` folder from the new xampp folder and add it to the `c:\xampp\php` folder
5. Copy the `php.ini` file from the old php folder
6. Download the thread safe (TS) xdebug for the new php version https://xdebug.org/download
7. Put it into `php\ext` and adapt the name in `php.ini`

For MySql its pretty similar except I would do a database dump 
