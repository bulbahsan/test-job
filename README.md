Настройка проекта:

Запустить установку контейнеров, используя команду:
bash ./clean.sh && bash ./install.sh

Путь к сайту: http://localhost

В тестовом файле ./Test.xlsx очищены формулы (неудалось реализовать chunk с формулами в файле т.к. 
следующая партия элементов не помнит предыдущие значения при расчете формул)

Для проверки работы laravel-cron в файле ./project/cron.log сохраняется время запуска laravel-команды по cron, которая запускается каждую минуту

#####
phpmyadmin - http://localhost:8080/
user: root
password: root
#####

#####
rabbitmq
http://localhost:15672/
user: guest
password: guest
#####