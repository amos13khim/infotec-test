<?php

declare(strict_types=1);

namespace app\services;

use Yii;

class SmsService
{
    public static function sendToPhone(string $phone, string $message): bool
    {
        $mode = Yii::$app->params['smsPilotMode'] ?? 'emulator';
        $apiKey = Yii::$app->params['smsPilotApiKey'] ?? 'emulator';
        $sender = Yii::$app->params['smsPilotSender'] ?? 'BooksCatalog';

        if ($mode === 'emulator' || $apiKey === 'emulator' || empty($apiKey)) {
            Yii::info('SMS emulator mode: phone=' . $phone . ', text=' . $message, 'sms');
            return true;
        }

        $url = 'https://smspilot.ru/api.php';
        $query = http_build_query([
            'apikey' => $apiKey,
            'sender' => $sender,
            'to' => $phone,
            'text' => $message,
        ]);

        $response = @file_get_contents($url . '?' . $query);
        if ($response === false) {
            Yii::warning('SMS sending failed for phone ' . $phone, 'sms');
            return false;
        }

        return true;
    }
}
