<?php

namespace App\Services;


class Logger
{

    const DIR = __DIR__ . '/../../logs/';

    static public function logError($text)
    {
        $path = __DIR__ . '/../../logs/error.log';
        if (!file_exists($path)) {
            mkdir(self::DIR);
        }
        $text = (new \DateTime())->format('Y-m-d H:m:s') . ' ' . $text . "\n";
        file_put_contents(self::DIR . 'error.log', $text, FILE_APPEND);
    }

    static public function log($text)
    {
        $path = __DIR__ . '/../../logs/info.log';
        if (!file_exists($path)) {
            mkdir(self::DIR);
        }
        $text = (new \DateTime())->format('Y-m-d H:m:s') . ' ' . $text . "\n";
        file_put_contents(self::DIR . 'info.log', $text, FILE_APPEND);
    }
}