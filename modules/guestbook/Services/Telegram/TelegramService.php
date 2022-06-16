<?php

declare(strict_types=1);

namespace Guestbook\Services\Telegram;


require 'Guzzle/vendor/autoload.php';

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

//echo '<pre>';
//print_r($config);
//echo '</pre>';
//die();

/**
 * Created by PhpStorm.
 * Filename: TelegramService.php
 * Project Name: john.loc
 * User: Акбарали
 * Date: 16/06/2022
 * Time: 16:47
 * Github: https://github.com/akbarali1
 * Telegram: @akbar_aka
 * E-mail: me@akbarali.uz
 */
class TelegramService
{
    public $bot_token;
    public $group_id;

    public function __construct()
    {
        $config = di('config')['johncms'];
        $this->bot_token = $config['bot_token'] ?? '';
        $this->group_id = $config['group_id'] ?? '';
//        echo '<pre>';
//        print_r($this->bot_token);
//        echo '</pre>';
//        die();
    }

    public function sendTelegram($array, $sending = 'sendMessage')
    {
        $client = new Client(['base_uri' => 'https://api.telegram.org/bot' . $this->bot_token . '/']);

        try {
            $client->post(
                $sending,
                [
                    'query' => $array,
                ]
            );
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    public function sendMessage($chat_id, $text, $parse_mode = 'HTML', $disable_web_page_preview = true, $disable_notification = false, $reply_to_message_id = null, $reply_markup = null): void
    {
        $send_array = [
            'chat_id'                  => $chat_id,
            'text'                     => $text,
            'parse_mode'               => $parse_mode,
            'disable_web_page_preview' => $disable_web_page_preview,
            'disable_notification'     => $disable_notification,
            'reply_to_message_id'      => $reply_to_message_id,
            'reply_markup'             => $reply_markup,
            'protect_content'          => false,
        ];
        $this->sendTelegram($send_array);
    }

    public function replyGuestbookNotification(string $text, string $chat_id, string $reply_name = ''): void
    {
        $message = "<i>Sizga chat orqali javob berishdi!</i>" . "\n";
        $message .= "Javob yozgan odam: <b>" . $reply_name . "</b>" . "\n";
        $message .= "Javob: <b>" . strip_tags($text) . "</b>";

        $this->sendMessage($chat_id, $message);
    }

    public function replyMessageNotification(string $text, string $chat_id, string $reply_name, $time, $write_id): void
    {
        $message = "<b>Sizga saytda shaxsiy habar yozishdi!</b>" . "\n";
        $message .= "Yozgan odam: <b>" . $reply_name . "</b>" . "\n";
        $message .= "Habar: <b>" . strip_tags($text) . "</b>" . "\n";
        $message .= "Yozgan vaqt: <b>" . date('d.m.Y H:i:s', $time) . "</b>";
        $reply_markup = [
            'inline_keyboard' => [
                [
                    [
                        'text' => "👀 Видеть сообщение",
                        'url'  => "http://" . $_SERVER['SERVER_NAME'] . "/mail/?act=write&id=" . $write_id,
                    ],
                ],
            ],
        ];

        $this->sendMessage($chat_id, $message, 'HTML', false, false, null, json_encode($reply_markup));
    }

}
