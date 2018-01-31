# Documentation for Game.
* Autor: VitaliI Minenko
* vers: 1.0.0
* Stworzony: 2018-01-31
## Config in .htaccess.
```apacheconfig
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-l
RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]
```

