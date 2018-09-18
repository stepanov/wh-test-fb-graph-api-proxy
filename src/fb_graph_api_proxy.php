<?php
/**
 * Script to proxy requests to Facebook Graph API
 *
 * user_id and access_token should be requested here:
 *
 *      https://developers.facebook.com/tools/explorer
 * 
 * @author: Mikhail Stepanov <stepanov.michael@gmail.com>
 *
 */

require_once __DIR__ . '/../vendor/autoload.php';
include_once __DIR__ . '/../config/config.php';

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\StreamHandler;

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
}

$params['query']['access_token'] = $config['token'];
$baseUrl = $config['host'] . '/' . $config['version'];

$handler = new StreamHandler();
$stack = HandlerStack::create($handler);
$client = new Client([
    'base_uri' => $baseUrl,
    'timeout'  => $config['time_out'],
    'handler' => $stack,
]);

try {
    $response = $client->request($method,  $baseUrl . '/' . $config['user_id'] . '/' . $uri, $params);
    
    echo $response->getBody();
} catch (Exception $e) {
    echo "Sending request to Facebook Graph API failed: " . $e->getMessage();
    exit;
}
