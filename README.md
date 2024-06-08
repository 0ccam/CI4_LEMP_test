# ci4_lemp_test
Тестовый проект сайта на CodeIgniter 4 + Nginx + PHP-FPM + MySQL + PhpMyAdmin.

## Инструкция по запуску проекта на локальном компьютере в командной строке Linux:
Для запуска потребуется [установить Docker](https://docs.docker.com/engine/install/), и не забыть выполнить [послеустановочные процедуры](https://docs.docker.com/engine/install/linux-postinstall/).
1. Создайте новую папку для проекта, например, Project, и перейдите в неё:
   ```
   $ mkdir Project
   $ cd Project/
   ```
2. Клонируйте git-репозиторий проекта в папку:
   ```
   $ git clone https://github.com/0ccam/ci4_lemp_test.git
   ```
3. Перейдите в папку ci4_lemp_test/
   ```
   $ cd ci4_lemp_test/
   ```
4. Чтобы сервер мог работать с некоторыми каталогами проекта, разрешите общий доступ к папке проекта (не следует так поступать в реальном проекте):
      ```
      $ sudo chmod 777 -R CI4
      ```
5. Разверните docker-контейнеры проекта:
   ```
   $ docker compose up -d
   ```
6. После удачной сборки и запуска контейнеров необходимо доустановить недостающие модули CodeIgniter с помощью Composer:
   ```
    $ docker exec -it php_fpm php /var/www/composer.phar install -d /var/www/
   ```
  ? 1. Откройте список запущенных контейнеров:
      ```
      $ docker ps
      ```
   ?2. В столбце CONTAINER ID найдите 12-ти значный идентификатор, соответсвующий контнейнеру с именем php_fpm.
   ?3. Запомните первые 2-3 символа идентификатора.
   ?4. Запустите Composer внутри контейнера, подставив запомненное значение вместо XXX:
      ```
      $ docker exec -it XXX php /var/www/composer.phar install -d /var/www/
      ```
7. Создать базу данных с именем ci4 в PhpMyAdmin
8. Запустить миграцию.

Файл .env изменён и исключен из gitignore

