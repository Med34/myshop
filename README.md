# My shopping cart

## Requirements
  * composer
  * php >= 7.1
  * webpack (symfony-encore)
  * sqlite3
  * nodeJS 10.13.0
  * yarn 1.12.3

## Installation
  * run git clone https://github.com/Med34/myshop.git command
  * run composer install command
  * run yarn install command to install frontend dependencies
  * run yarn encore dev to compile assets once
  * run php bin/console doctrine:migrations:migrate to add database tables
  * run php bin/console doctrine:fixtures:load to load default products
  * run php bin/console server:run to run a local server
  * go to the http://localhost:8000 url to test the website