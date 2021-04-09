# Installation on localhost

-  setup development domains
```bash
echo "127.0.0.1    search-house.local.com" | sudo tee -a /etc/hosts
```

- apache virtualhost config
```bash
sudo nano /etc/apache2/sites-available/search-house.local.com.conf

cp to search-house.local.com.conf file:
<VirtualHost *:80>
ServerName search-house.local.com
ServerAlias www.search-house.local.com
ServerAdmin webmaster@localhost
DocumentRoot /path/to/your/project/search-house/public/
ErrorLog ${APACHE_LOG_DIR}/error.log
CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>

sudo a2ensite search-house.local.com.conf
sudo service apache2 reload
```

- switch to sources folder
```bash
cd project
```

- install dependencies
``` bash
yarn insall
composer install
```


- setup environment configuration
```bash
cp .env.example .env
```

- run this code for create the symbolic link
```bash
php artisan storage:link
```

- setup database
```bash
php artisan migrate --seed
```

- configure permissions
```bash
chmod 777 -R storage bootstrap/cache
```

- build npm
```bash
yarn dev
```
