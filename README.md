# README #

Проект представляет собой прохождения тестового задания для компании fpxmax

# Постановка задачи #

#### Условия

Тестовое задание:

API:
https://developers.pandascore.co/doc/#operation/get_csgo_matches_upcoming
https://api.pandascore.co/csgo/matches/upcoming?token=***

https://pandascore.co/settings
login: ***
password: ***

Создать парсер матчей, добавление новых лиг в соотвесттвующую таблицу и команд.

Результат работы как минимум 3 заполненные таблицы и грамотно оформленный код.
Выполнить на фреймворке Laravel

### How do I get set up? ###

Для разворачивания проекта необходимо:
1. `git clone`
2. `composer install`
3. `npm install && npm run development` (node 9)
4. set ports in docker-compose.override.yml
5. `docker-compose up -d`
6. `docker-compose exec -u www-data app bash -c "php artisan migrate"`
7. `docker-compose exec -u www-data app bash -c "php artisan queue:work"`

Или развернуть любым другим удобным способом, например `php artisan serve`

### Готовые ссылки ###

https://fpsmax-test.malahov-artem.ru/

### Затраченное время ###

4 часа

### TODO

* в процессе работы по лимитам отвалилась апи (видимо токен использую не я один).
следует проверить sync team<->match

* после ресинка требуется обновлять страницу. 
вообще страницы не было в тз, как ресинк должен запускаться (job,api,shedule) - открытый вопрос.
но в текущей реализации со страницы. но ее надо обновлять.
в идеале надо развернуть laravel-echo и вещать события на клиент через websocket
чтобы получать resyncComplete и рефрешить списки. но это сильно выходит за рамки задания...
