<?php

declare(strict_types=1);

use Johncms\Notifications\Notification;
use Notifications\Install\SenjeInstaller;

defined('_IN_JOHNCMS') || die('Error: restricted access');

$data = [];
$notifications = 0;

$all_counters = $counters->notifications();

// Новые сообщения на форуме
if (isset($all_counters['forum_new']) && $all_counters['forum_new'] > 0) {
    $notifications += $all_counters['forum_new'];
}

// Личные сообщения
if (! empty($all_counters['new_mail'])) {
    $notifications += $all_counters['new_mail'];
}

// Комментарии в личной гостевой
if (! empty($all_counters['guestbook_comment'])) {
    $notifications += $all_counters['guestbook_comment'];
}

// Комментарии в альбомах
if (! empty($all_counters['new_album_comm'])) {
    $notifications += $all_counters['new_album_comm'];
}

if ($user->comm_count > $user->comm_old) {
    $notifications += $user->comm_count - $user->comm_old;
}


header('Content-Type: application/json; charset=utf-8');
echo json_encode(['count' => $notifications]);

