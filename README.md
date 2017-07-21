# Тестовое задание (API) #

## Установка ##

Необходимо иметь уже установленный **docker** и **docker-compose**.

**Клонируем проект:**

``git clone https://github.com/ivagen/test2.git .``

**Заходм в папку проекта:**

``cd path/to/project/``

**Поднимаем docker контейнер:**

``sh docker/bash/run.sh`` или ``docker-compose up -d``

**Заходим в контейнер:**

``sh docker/bash/ssh.sh`` или ``docker exec -i -t test_front /bin/bash``

**В контейнере сразу попадаем в папку проекта:**

``/var/www/``

**Запускаем установочный скрипт:**

``sh setup.sh``

## Проект готов к использованию

**Ссылка для получения данных http://0.0.0.0/getRequest**

**Ссылка для добавления данных http://0.0.0.0/storeRequest/{route} (где {route} изменяемая часть)**

**Запустить тесты :**

``phpunit src/AppBundle/Tests/``

**Для более красивого имени сайта нужно добавить записть в файл /etc/hosts :**

``0.0.0.0 test.local``

**База данных доступна по адресу http://0.0.0.0:4001 .**

*Сервер:* ``mysql``

*Имя пользователя:* ``symfony``

*Пароль:* ``symfony``

*База данных:* ``symfony``

**Выход из контейнера:** ``exit``

**Удалить все контейнеры:**

``cd path/to/project/``

``sh docker/bash/rmi.sh``

## P.S. ##
*Если при сборке контейнера или разворачивании проекта что-то пошло не так - попытайтесь перезустить процесс.*

*Если при сборке docker контейнера консоль ругается на занятые порты - попытайтесь их освободить.*

*Если ничего не помогает - действуйте по обстоятельствам.*