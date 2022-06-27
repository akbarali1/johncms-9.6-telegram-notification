<?php

declare(strict_types=1);

use Johncms\Notifications\Notification;
use Notifications\Install\SenjeInstaller;

defined('_IN_JOHNCMS') || die('Error: restricted access');

SenjeInstaller::install();

$notification = (new Notification())->where('notificated', 0)->where('user_id', $user->id)->count();

header('Content-Type: application/json; charset=utf-8');
echo json_encode(['count' => $notification]);

