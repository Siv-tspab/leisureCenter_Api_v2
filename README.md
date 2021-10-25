# leisureCenter_Api
A simple exemple of a leisure center Api build with API Platfom.

## Installation

Start by cloning the repository with the following command :

```
git clone https://github.com/Siv-tspab/leisureCenter_Api_v2.git
```
Then:
```
composer install
```

Make sure that your server use PHP 8.

Once it's done, you have to configure and create the dataBase, and then import the data. For this exemple I've use mariadb as database :


### 1. Database

Replace that line into the `.env` file
```
DATABASE_URL="postgresql://db_user:db_password@127.0.0.1:5432/db_name?serverVersion=13&charset=utf8"
```
with some thing like (depending on your own database configuration):
```
DATABASE_URL="mysql://root@127.0.0.1:3306/leisurecenter?serverVersion=mariadb-10.4.17"
```
(You can also create a `.env.local` and specifiate your configuration, it'll overload the `.env`)

Then you can run create the database:
```
$ php bin/console doctrine:database:create
```
Once it's creat, import the `leisurecenter.sql` into your database.


### 2. API KEYS
Last thing to do into the `.env` file your own api keys for OpenWeathermap and MapBox like this:
```
OWM_API_KEY="xXXXXXXXXXXXxxxxxXXxxXXxXXXXXXXXX"
MB_API_KEY="xx.XXXXXxxxxXXXxxXxXXXxXxxxXXxXxXXxXXXXxxXXXxXxxXxxXXXxxxXXXxXX.XxXxxxXxxxxXXXXxxXX"
```

## How it's work

The documentation is available on swagger and json document at these address:
- https://{your_server}/doc
- https://{your_server}/doc.json

All the routes are referenced here, you can test with an http client or with the sawgger_ui.
