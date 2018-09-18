<?php

require_once __DIR__ . '/../vendor/autoload.php';
include_once __DIR__ . '/../config/config.php';

use GuzzleHttp\Client;

if (!empty($_GET)) {
    $method = 'GET';
    $params = [
        'query' => $_GET
    ];
    $uri = !empty($_GET['uri']) ? $_GET['uri'] : '';
} else if (!empty($_POST)) {
    $method = 'POST';
    $params = [
        'form_params' => $_POST
    ];
    $uri = !empty($_POST['uri']) ? $_POST['uri'] : '';
} else {
    die("Empty request!");
}

$params['query']['access_token'] = $config['token'];

$client = new Client([
    'base_uri' => $config['host'] . '/' . $config['version'],
    'timeout'  => $config['time_out'],
]);

try {
    $response = $client->request($method, '/' . $config['user_id'] . '/' . $uri, $params);
} catch (Exception $e) {
    die("[Exception] cannot send request: " . $e->getMessage());
}

echo $response->getBody();
