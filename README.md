# [JohnCMS](https://johncms.com)

[![GitHub](https://img.shields.io/github/license/johncms/johncms?color=blue)](https://github.com/johncms/johncms/blob/develop/LICENSE)
[![Source Code](http://img.shields.io/badge/source-johncms/johncms-blue.svg)](https://github.com/johncms/johncms)
[![GitHub tag (latest SemVer)](https://img.shields.io/github/tag/johncms/johncms.svg?label=stable)](https://github.com/johncms/johncms/releases)

[![PHP-CI](https://github.com/johncms/johncms/workflows/PHP-CI/badge.svg?branch=develop)](https://github.com/johncms/johncms/actions)
[![Crowdin](https://badges.crowdin.net/johncms/localized.svg)](https://crowdin.com/project/johncms)

Система управления сайтом JohnCMS предназначена для построения сайтов, которые будут просматриваться с мобильных телефонов.

## Основные возможности системы:
- мультиязычность
- высокий уровень безопасности
- форум с возможностью закрепления/закрытия тем, созданием голосований,
  возможностью прикрепления файлов в теме и т.д...
- личные Фотоальбомы
- личные Гостевые книги
- библиотека с неограниченной вложенностью разделов и возможностью для посетителей сайта публиковать свои статьи. Модерация статей, компиляция FB книг.
- загруз центр с неограниченной вложенностью разделов, рейтингом, комментариями.
- приват (личная почта) с возможностью прикрепления файлов
- и многое другое...

## Системные требования
- Версия PHP не ниже 7.2
- MySQL версии не ниже 5.6.4 и должен использоваться MySQL Native Driver (mysqlnd)
- Поддержка .htaccess

## Установка из репозитория
1. У Вас должен иметься [Composer](https://getcomposer.org/), [Node.js](https://nodejs.org/), компьютер должен быть подключен к Internet.  
2. В консоли выполните команду `composer install` для установки всех зависимостией.
3. Выполните команду `npm install` для установки зависимостей, необходимых для сборки js и css файлов.
4. Выполните команду `npm run prod` для сборки css и js файлов.
5. Наберите в браузере адрес: http://ваш.сайт/install
6. Запустится Инсталлятор, далее следуйте его инструкциям
7. После установки **обязательно** удалите каталог /install

## Установка из дистрибутива
1. Распакуйте архив с дистрибутивом JohnCMS, загрузите файлы на свой сервер.
2. Наберите в браузере адрес: http://ваш.сайт/install
3. Запустится Инсталлятор, далее следуйте его инструкциям
4. После установки **обязательно** удалите каталог /install

## Решение проблем
При обновлении из репозитория необходимо следить за тем, что именно изменилось.
- Если изменился файл composer.json, вероятнее всего вам нужно будет выполнить команду `composer install` ещё раз.
- Если изменились файлы scss, css, js, то вероятнее всего нужно выполнить команду `npm run prod` ещё раз.
- Если изменился файл package.json, то скорее всего нужно выполнить команду `npm install`, и после этого команду `npm run prod`
- Если вы изменяете файлы scss, css, js, которые используются в шаблоне, то возможно вам будет удобно использовать команду `npm run watch` для автоматической компиляции файлов при изменении.
#   j o h n c m s - 9 . 6 - t e l e g r a m - n o t i f i c a t i o n  
 