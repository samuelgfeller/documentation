# How to install XAMPP with a custom folder name on Windows

Since there is no built in function to update XAMPP ([there is to update PHP](https://php.tutorials24x7.com/blog/how-to-update-php-version-in-xampp-on-windows)) I like to name the folder with the PHP-Version like `/xampp7.4.3/`. This can be defined 
in the installer but it sill writes `/xampp/` in the apache config files so when starting apache XAMPP will display this error:
> Error: Apache shutdown unexpectedly.  
This may be due to a blocked port, missing dependencies,   
improper privileges, a crash, or a shutdown by another method.  

Which is caused by: 
> [ERROR] Can't find messagefile 'C:\xampp\mysql\share\errmsg.sys'  
[ERROR] Aborting httpd.exe: Syntax error on line 537 of C:/xampp7.4.3/apache/conf/httpd.conf: Syntax error on line 17 of C:/xampp7.4.3/apache/conf/extra/httpd-xampp.conf: Cannot load /xampp/php/php7ts.dll into server: Das angegebene Modul wurde nicht gefunden.

## Change the path with `setup_xampp.bat` script
The XAMPP installer installs a little script `C:/xampp/setup_xampp.bat` which when you execute, updates all path.
For this script to work though you have to install the Microsoft Visual C++ Redistributable for Visual Studio 2019 which can be found [here](https://visualstudio.microsoft.com/downloads/) if you scroll down to *Other Tools and Frameworks*<sup>[1](#myfootnote1)</sup>.


## Change the path names manually

This method only worked partially for me. It got rid of the apache error but this error message kept preventing the start:  
> [ERROR] Can't find messagefile 'C:\xampp\mysql\share\errmsg.sys'  

### Step 1 
Download the version you need: https://www.apachefriends.org/download.html

### Step 2
Execute the installer and when asked, type your custom instllation folder name

### Step 3
Search the useses of `xampp` in the apache directory.  
I will use the great tool [Everything](https://www.voidtools.com/support/everything/) which you can download [here](https://www.voidtools.com/downloads/). But [Notepad ++](https://notepad-plus-plus.org/downloads/) works just as fine with it's [find in files](https://i.imgur.com/JnUbOo6.png) feature.

Open *Everything* and type in `\xampp7.4.3\apache content:xampp` to search all files containing the word xampp in the apache directory.

### Step 4
Open each file and replace the word `xampp` **when used as root path** with your custom name

### Step 5
Open XAMPP again and start apache



---- 
## Sources:
<a name="myfootnote1">1</a>: https://stackoverflow.com/a/59414266/9013718

