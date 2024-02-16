<?php

namespace App\Services;


class Logger
{
    static public function logError($text)
    {
        $text = (new \DateTime())->format('Y-m-d H:m:s') . ' ' . $text . "\n";
        file_put_contents(__DIR__ . '/../../logs/error.log', $text, FILE_APPEND);
    }

    static public function log($text)
    {
        $text = (new \DateTime())->format('Y-m-d H:m:s') . ' ' . $text . "\n";
        file_put_contents(__DIR__ . '/../../logs/info.log', $text, FILE_APPEND);
    }
}