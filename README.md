# Environment setup instructions

- Copy `.env.example` to `.env` and fill in the desired database username and password

- Edit `phinx.yml` (development environment) and add in the database username and password

 - Run: `docker-compose build Dockerfile`

 - Run: `docker-compose up -d`

 - To connect to `emagia_app` container run : `docker exec -it php-app bash`

 - To connect ot mysql container run : `docker exec -it mysql-db bash`

- Connect to `emagia_app` container and run: `composer install` (this should run by default)

## Migrations/Seeds

To run the migrations connect ot the emagia_app container and run:

`vendor/bin/phinx migrate`

`vendor/bin/phinx seed:run`

To check if the data is populated you can connect to the mysql container and run:

`mysql -u <your username> -p`

Enter your password and then enter the following commands:

`use database;`

`select * from skills;`

`select * from characters;`

Or if you didn't run the seeders you can type in the following to observe if the table structure was created:

`DESCRIBE skills;`

`DESCRIBE characters;`


## Tests

In order to execute the tests run the following command:

`./vendor/bin/phpunit --testdox tests`

Or the following for non-verbose:

`./vendor/bin/phpunit tests`



## Documentation:

- Database connection and adapter

https://docs.laminas.dev/laminas-db/adapter/

- Logging 

https://packagist.org/packages/psr/log

- Assertions

https://github.com/beberlei/assert

- Migrations/Seeds

https://book.cakephp.org/phinx/0/en/intro.html


- Service Manager

https://docs.laminas.dev/laminas-servicemanager/


## Screenshots

![A try to build the browser interface](screenshots/webapp.png?raw=true "Browser game")

![An output of one game](screenshots/game1.png?raw=true "Cli game")

![An output of one game](screenshots/game2.png?raw=true "Cli game")

![An output of one game](screenshots/game3.png?raw=true "Cli game")

![The successful execution of the current tests](screenshots/tests.png?raw=true "Tests")