# ci4_lemp_test
Тестовый проект на CodeIgniter 4 + Nginx + PHP-FPM + MySQL

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
4. Разверните docker-контейнеры проекта:
   ```
   $ docker compose up -d
   ```
5. 
