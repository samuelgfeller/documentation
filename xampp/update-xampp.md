# Update XAMPP with a different folder name

Since there is no built in function to update XAMPP I like to name the folder with the PHP-Version like `/xampp7.4.3/`. This can be defined 
in the installer but it sill writes `/xampp/` in the apache config files so when starting apache XAMPP will display this error:
> Error: Apache shutdown unexpectedly.  
This may be due to a blocked port, missing dependencies,   
improper privileges, a crash, or a shutdown by another method.  

Which is caused by: 
> 2020-03-17 11:09:15 0 [ERROR] Can't find messagefile 'C:\xampp\mysql\share\errmsg.sys'  
2020-03-17 11:09:15 0 [ERROR] Aborting  
httpd.exe: Syntax error on line 537 of C:/xampp7.4.3/apache/conf/httpd.conf: Syntax error on line 17 of C:/xampp7.4.3/apache/conf/extra/httpd-xampp.conf: Cannot load /xampp/php/php7ts.dll into server: Das angegebene Modul wurde nicht gefunden.
