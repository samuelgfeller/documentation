# Update XAMPP with a different folder name

Since there is no built in function to update XAMPP I like to name the folder with the PHP-Version like `/xampp7.4.3/`. This can be defined 
in the installer but it sill writes `/xampp/` in the apache config files so when starting apache XAMPP will display this error:
> Error: Apache shutdown unexpectedly.  
This may be due to a blocked port, missing dependencies,   
improper privileges, a crash, or a shutdown by another method.  

Which is caused by: 
> [ERROR] Can't find messagefile 'C:\xampp\mysql\share\errmsg.sys'  
[ERROR] Aborting httpd.exe: Syntax error on line 537 of C:/xampp7.4.3/apache/conf/httpd.conf: Syntax error on line 17 of C:/xampp7.4.3/apache/conf/extra/httpd-xampp.conf: Cannot load /xampp/php/php7ts.dll into server: Das angegebene Modul wurde nicht gefunden.

## How to install XAMPP with a custom folder name on Windows 

### Step 1 
Download the version you need: https://www.apachefriends.org/download.html

### Step 2
Execute the installer and when asked, type your custom instllation folder name

### Step 3
Search the useses of `xampp` in the apache directory.  
I will use the great tool [Everything](https://www.voidtools.com/support/everything/) which you can download [here](https://www.voidtools.com/downloads/). But [Notepad ++](https://notepad-plus-plus.org/downloads/) works just as fine with it's "search in files" feature.

Open *Everything* and type in `\xampp7.4.3\apache content:xampp` to search all files containing the word xampp in the apache directory.

### Step 4
Open each file and replace the word `xampp` **when used as root path** with your custom name

