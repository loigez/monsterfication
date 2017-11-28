monsterfication
===============

http://localhost:8000/

#INSTALL
### PROJECT
* git clone https://github.com/loigez/monsterfication.git
* cd monsterfication
* composer install
###SERVER
* cd monsterfication
./bin/php bin/console server:run
###DB
* docker pull mariadb:latest
* docker run -p 8306:3306 -e MYSQL_ROOT_PASSWORD=root -d mariadb
* php bin/console doctrine:database:create


##TIPS
* generate schema
php bin/console doctrine:schema:update --force

* validate schema
php bin/console doctrine:schema:validate