## Для запуска приложения вам нужно иметь установленный docker и docker-compose

1) Собрать контейнеры командой ``` docker-compose up -d --build ```
2) Установить зависимости для php приложения ``` docker exec php composer install ```
3) Создать базу данных ``` docker exec -i mysql mysql -uroot -pArsenal799! -e 'CREATE DATABASE employers_db' ``` 
4) Перенести данные из дампа базы ``` docker exec -i mysql mysql -uroot -pArsenal799! employers_db < schema.sql ```
5) Ввести команду ``` docker exec -i php php  bin/console orm:generate-proxies ``` для генерации прокси для орм (работа в прод среде)

