## Update xampp
There was problem after problem when trying to update php without installing the whole new xampp so I would actually recommend to just download the new xampp and transfer the config over there even if its very annoying. Insane that there is no way of updating xampp without loosing all the apache/php configuration, database and htdocs.

1. Open Services.msc
2. Stop the service `Apache`
3. Rename the `c:/xampp` folder
4. Download latest xampp installer https://www.apachefriends.org/download.html and install it
5. Transfer everything needed from the old xampp folder
    * `htdocs` folder content
    * `apache/conf/httpd.conf`, `apache/conf/extra/httpd-vhosts.conf`
    * `php.ini` (`memory_limit`, enabled `extension`, etc.) 
    * Download the thread safe (TS) xdebug for the new php version https://xdebug.org/download
    * Put it into `php\ext` and adapt the name in `php.ini`
7. Start apache service
8. Update `github/build.yml` php version

   

## Update PHP or MySql without updating xampp

1. Download latest xampp installer https://www.apachefriends.org/download.html
2. Install xampp to a new path e.g. "c:\xampp8.3"
3. Rename the `php` folder in the `xampp` folder
4. Copy the `php` folder from the new xampp folder and add it to the `c:\xampp\php` folder
5. The `php.ini` of the old php folder cannot be taken unfortunately, it creates a stack overflow error so everything that was changed in the old `php.ini` has to be adapted in the new one (`memory_limit`, xdebug config, enabled `extension`, etc.)
6. Download the thread safe (TS) xdebug for the new php version https://xdebug.org/download
7. Put it into `php\ext` and adapt the name in `php.ini`

**Fix** *Hmmm… can't reach this page. The connection was reset.* error `child process 12712 exited with status 3221225477` 
For the php 8.1 to 8.2 upgrade, the `apache` folder of the new xampp had to be copied as well. 
1. Rename old `apache` folder
2. Copy `apache` folder from freshly installed xampp folder and put it in `c:\xampp`
3. Replace the files from the new `apache` folder with those from the old one that had a special configuration (`httpd.conf` and `extra\httpd-vhosts.conf`)
4. Open the `C:\xampp\apache\conf\extra\httpd-xampp.conf` file and replace the xampp path of the installed directory (e.g. `xampp8.3`) with `xampp` with search and replace

For MySql its pretty similar except I would do a database dump 
