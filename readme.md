**1) В корневом каталоге выполнить команду** 
- composer install

**2) Создать локальную базу данных для проекта**

**3) В корне проекта переименовать файл .env.example на .env и
Редактировать строки :**
- DB_DATABASE= (название базы данных)
- DB_USERNAME= (имя пользователя)
- DB_PASSWORD= (пароль пользователя)

**4) В корне проекта выполнить команды** 
- php artisan key:generate (создание ключа)
- php artisan migrate (миграции)
- php artisan db:seeds (создание пользователя который уже был забит) 
Либо
- php artisan user:create login email password permissions (root = 1) (создание пользователя)

**5) В папке /public/admin/dev выполнить команду**
- npm install

**6) В папке /public/admin/dev выполнить команду** 
- npm run build

**7) В корне проекта выполнить команду:**
- php artisan serve (запуск проекта)
