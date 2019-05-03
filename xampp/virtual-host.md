# Redirect URL to local project XAMPP

SSL Certificate: https://shellcreeper.com/how-to-create-valid-ssl-in-localhost-for-xampp/ 

## Add entry in host
`C:\Windows\System32\drivers\etc\hosts`
```
127.0.0.1     dev.masesselin  
127.0.0.1     dev.pubg  
127.0.0.1     dev.migration
```  
_something.dev [wont work on http](https://ma.ttias.be/chrome-force-dev-domains-https-via-preloaded-hsts/)_
## Edit httpd.conf
`C:\xampp\apache\conf\httpd.conf`
```apache
<Directory />
    AllowOverride none
    Require all granted
</Directory>
```
## Edit httpd-vhosts.conf 
`C:\xampp\apache\conf\extra\httpd-vhosts.conf`
```apache
<VirtualHost *:80>
     ServerName dev.migration
     DocumentRoot "C:\xampp\htdocs\axiom_migration"
     <Directory "C:\xampp\htdocs\axiom_migration">
         DirectoryIndex index.php
     </Directory>
 </VirtualHost>
```
### Restart apache
Stop and restart apache on xampp

***

Source: https://stackoverflow.com/a/38567050/9013718
