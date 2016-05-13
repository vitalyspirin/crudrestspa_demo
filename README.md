# Demo of application implementing CRUD, REST, SPA.

- On the server side Yii2 with ActiveController is used. 
- On the client side it's AngularJS.
- For testing I used Codeception (that comes with Yii).


## Installation
```
git clone git@github.com:vitalyspirin/crudrestspa_demo.git
composer global require "fxp/composer-asset-plugin:~1.1.1"
cd crudrestspa_demo/server
composer install
```
Folders "client" and "server" potentially can be on different hosts and therefore all server dependencies should be located inside "server/vendor" folder.

## Client side

Client app implements typical CRUD using Bootstrap template:

![client_index.png](/docs/client_index.png "client index")


## Swagger UI

Shows end points of RESTful interface.

![swagger.png](/docs/swagger.png "swagger")


## Server tests

![server_tests.png](/docs/server_tests.png "server tests")
