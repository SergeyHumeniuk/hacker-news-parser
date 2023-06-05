<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

// Создаем HTTP-клиент
$client = new Client();

// URL Hacker News
$url = 'https://news.ycombinator.com';

// Получаем URL-путь из запроса
$requestPath = $_SERVER['REQUEST_URI'];

// Формируем прокси-URL путем объединения URL Hacker News и URL-пути из запроса
$proxyUrl = $url . $requestPath;

// Создаем HTTP-запрос на Hacker News
$request = new Request($_SERVER['REQUEST_METHOD'], $proxyUrl);

try {
    // Отправляем HTTP-запрос и получаем ответ от Hacker News
    $response = $client->send($request);

    // Получаем тело ответа
    $body = $response->getBody();

    // Модифицируем текст на странице
    $modifiedBody = preg_replace('/(\b\w{6}\b)/u', '$1™', $body);

    // Выводим модифицированный текст
    echo $modifiedBody;
} catch (RequestException $e) {
    // Обработка ошибок при запросе
    echo 'Error: ' . $e->getMessage();
}
?>