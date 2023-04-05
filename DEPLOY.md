
# Ticket Service (Deploy)

### Step by step
#### Clone this Repository
```sh
git clone https://github.com/moharami/Ticket Ticket
```

#### Install project dependencies
```sh
composer install
```

#### Create the .env file
```sh
cd Ticket/
cp .env.example .env
```

#### Generate the Laravel project key
```sh
php artisan key:generate
```


#### migration and seeding data
```sh
php artisan migrate:refresh --seed
```


#### Running Test

```sh
php artisan test
```

#### Running Command for Cancling Reserve Ticket
```sh
php artisan reserve:cancle
```


#### Schedule task for running automatic cancle Reserve every minute

##### localy
```sh
php artisan schedule:work
```
##### on the server
```sh
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```
