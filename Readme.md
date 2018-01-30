# Documentation for Benchmark test.
* Autor: VitaliI Minenko
* vers: 1.0.0
* Stworzony: 2018-01-29
## Config in .htaccess.
```apacheconfig
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-l
RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]
```
##### Base work with application.

* Urls can be put into field in formats: www.exempl.com, http://www.exempl.com, http://exempl.com;
* Input into fieldOur one base url. Field can take only one Url.
* Input into Another urls field list of urls use whitespace for delimiter.For exemple http://www.exempl.com  exempl.com;
* You can put into this field as many urls as allow limit in 1000 characters.
* Put Submit for do test.
* After any seconds you can see result of test.
* You can download log file using Download button.
