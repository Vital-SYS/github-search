# GitHub-search

## Требования

- PHP >= 7.4
- Composer
- СУБД SQLite

## Установка

1. Клонируйте репозиторий:
```
git clone https://github.com/Vital-SYS/github-search.git
```
2. Перейдите в каталог проекта:
```
cd your-repo
```
3. Установите зависимости, используя Composer, а также npm:
```
composer install
npm install
```
4. Создайте копию файла .env и настройте соединение с базой данных:
```
cp .env.example .env
```
5. Создайте файл базы данных SQLite:
```
touch database/database.sqlite
```
6. Настройте файл .env, указав путь к базе данных SQLite:
```
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/your/database.sqlite
```
7. Сгенерируйте ключ приложения:
```
php artisan key:generate
```
8. Выполните миграции базы данных:
```
php artisan migrate
```
9. Запустите веб-сервер разработки:
```
php artisan serve
```
