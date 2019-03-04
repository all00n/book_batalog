# 

test task silin stanislav.

## Installation

clone project.

```bash
cd book_catalog
```
```bash
composer install
```

## database configure
```sql
CREATE SCHEMA `step` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ;
```
in file config/db.php
set your database settings
```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=step',
    'username' => 'username',
    'password' => 'password',
    'charset' => 'utf8mb4',
];
```
run migrations
```bash
php migrate
```
start local server
```bash
php yii serve
```
go to http://localhost:8080/