# Local certificate

## 2. Create a folder in that page.
This is where we will store our cert. In this example I will create “crt” folder. So we will have C:\xampp\apache\crt

## 3. Add this files.
[cert.conf](https://gist.github.com/turtlepod/3b8d8d0eef29de019951aa9d9dcba546)  
[make-cert.bat](https://gist.github.com/turtlepod/e94928cddbfc46cfbaf8c3e5856577d0)
## 4. Edit cert.conf and Run make-cert.bat
Change {{DOMAIN}} text using the domain we want to use, in this case site.test and save.

Double click the make-cert.bat and input the domain site.test when prompted. And just do enter in other question since we already set the default from cert.conf.



Note: I don’t know how to do text replace in .bat script, if you do, let me know in the comment how to do it and I will update make-cert.bat to automatically replace the {{DOMAIN}} with the domain input.

## 5. Install the cert in windows.
After that, you will see site.test folder created. In that folder we will have server.crt and server.key. This is our SSL certificate.

Double click on the server.crt to install it on Windows so Windows can trust it.

And then select Local Machine as Store Location.

And then Select “Place all certificate in the following store” and click browse and select Trusted Root Certification Authorities.

Click Next and Finish.

And now this cert is installed and trusted in Windows. Next is how how to use this cert in XAMPP.

## 6. Add the site in Windows hosts
Open notepad as administrator.
Edit C:\Windows\System32\drivers\etc\hosts (the file have no ext)
Add this in a new line:
`127.0.0.1 site.test`
This will tell windows to load XAMPP when we visit http://site.test You can try and it will show XAMPP dashboard page.

## 7. Add the site in XAMPP conf.
We need to enable SSL for this domain and let XAMPP know where we store the SSL Cert. So we need to edit C:\xampp\apache\conf\extra\httpd-xampp.conf

And add this code at the bottom:
```
 <VirtualHost *:80>
     DocumentRoot "C:/xampp/htdocs"
     ServerName site.test
     ServerAlias *.site.test
 </VirtualHost>
 <VirtualHost *:443>
     DocumentRoot "C:/xampp/htdocs"
     ServerName site.test
     ServerAlias *.site.test
     SSLEngine on
     SSLCertificateFile "crt/site.test/server.crt"
     SSLCertificateKeyFile "crt/site.test/server.key"
 </VirtualHost>
 ```
After that, you will need to restart Apache in XAMPP.  It’s very simple, simply open XAMPP Control Panel and Stop and re-Start Apache Module.

Tips: In XAMPP conf, as you can see you can change the domain root directory if needed. Eg. as sub-dir in htdocs.

## Restart your browser and Done!


---
Source: https://shellcreeper.com/how-to-create-valid-ssl-in-localhost-for-xampp/
