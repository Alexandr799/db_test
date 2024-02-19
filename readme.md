# Тестовое приложение по работе с БД (php + mysql)

## Фукнционал программы

1) ``` php index.php import positions.csv ``` — добавляет в БД указанные в файле positions.csv
должности и ставки оплаты труда;
2) ``` php index.php import employees.csv ``` — добавляет в БД указанные в файле employees.csv
должности и ставки оплаты труда;
3) ``` php index.php import timesheet.csv ``` — добавляет в БД указанные в файле timesheet.csv
периоды работы сотрудников над задачами;
4) ``` php index.php list employee ``` — выводит и перечисляет сотрудников по именам;
5) ``` php index.php get [employeeName] ``` — выводит таймшиты сотрудника по его имени;
6) ``` php index.php remove [employeeName] ``` — удаляет данные по сотруднику из таймшита по его имени;
7) ``` php index.php report Top5longTasks ``` — выводит пять задач, на которые потрачено больше
всего времени;
8) ``` php index.php report Top5costTasks ``` — выводит пять задач, на которые потрачено больше
всего денег;
9) ``` php index.php report Top5employees ``` — выводит пять сотрудников, отработавших наибольшее количество времени за всё время.

*** Приложение работает в докере, также что для работы программы нужно либо зайти в контейнре ``` docker exec -it php bash ```  
и вызывать команды отттуда или перед командой использовать префикс docker exec -i php (например ``` docker exec -i php php index.php  Top5employees ``` )

## Для запуска приложения вам нужно иметь установленный docker и docker-compose

1) Собрать контейнеры командой ``` docker-compose up -d --build ```
2) Установить зависимости для php приложения ``` docker exec php composer install ```
3) Создать базу данных ``` docker exec -i mysql mysql -uroot -p`ВСТАВЬТЕ ВАШ ПАРОЛЬ от БАЗЫ ДАННЫХ!` -e 'CREATE DATABASE employers_db' ``` 
4) Перенести данные из дампа базы ``` docker exec -i mysql mysql -uroot -p`ВСТАВЬТЕ ВАШ ПАРОЛЬ от БАЗЫ ДАННЫХ!` employers_db < schema.sql ```
5) Ввести команду ``` docker exec -i php php  bin/console orm:generate-proxies ``` для генерации прокси для орм (работа в прод среде)
6) Создайте файл .env в ./app (пример файла в .env-example)
7) Пароль для базы даных нужно будет указать также в .env файле (создайте его в корне проекта для докер композа)

