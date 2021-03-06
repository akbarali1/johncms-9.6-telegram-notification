"use strict";

(setInterval(async function () {
    let getNotification = await fetch('/notifications/ajax/');
    if (getNotification.ok) {
        let responce = await getNotification.json();
        if (responce.count) {

            // Мигающий <title>
            var replacement = '*** ' + responce.count + ' новых уведомлений ***';
            var heading     = document.title;
            setInterval(function () {
                if (document.title == heading) {
                    document.title = replacement;
                } else {
                    document.title = heading;
                }
            }, 1000);

            // Меняем добавляем счетчик уведомлений в sidebar

            let notification     = document.querySelector('.sidebar_user_avatar > .position-relative > .sidebar__notifications');
            let menuNotification = document.querySelector('a[href="/notifications/"] > .badge');
            // Если до этого были уведомления, то прибавляем к ним на 1
            if (notification && menuNotification) {
                notification.textContent     = responce.count;
                menuNotification.textContent = responce.count;
            } else {
                // Если уведомлений не было, добавляем в DOM элемент
                addToDOM('.sidebar_user_avatar > .position-relative');
                addToDOM('a[href="/notifications/"]', false);
            }

            // Запускаем уведомление
            let audio = document.getElementById('notification_audio');
            audio.play();
        }
    }
}, 5000));

function addToDOM(parent, avatar = true) {
    parent    = document.querySelector(parent);
    let child = parent.firstChild;
    if (avatar) {
        let element = document.createElement('div');
        element.classList.add('sidebar__notifications', 'badge', 'badge-danger', 'badge-pill');
        element.textContent = '1';
        parent.insertBefore(element, child);
    } else {
        let element = document.createElement('span');
        element.classList.add('badge', 'badge-danger', 'badge-pill');
        element.textContent = '1';
        parent.appendChild(element);
    }
}
