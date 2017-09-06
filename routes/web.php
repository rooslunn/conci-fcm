<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->group(['prefix' => 'api/v1', 'middleware' => 'auth:api'], function ($app) {
    $app->post('/test', 'TestMessageController');
});

$app->get('/test', function () {
    $request = new \GuzzleHttp\Psr7\Request('POST', env('FCM_SERVER'), [
        'Content-Type' => 'application/json',
        'Authorization' => 'key=' . env('FCM_SERVER_KEY'),
    ], json_encode([
        'data' => [
            'lat' => 15,
            'lon' => 15,
        ],
//        'to' => env('FCM_TEST_ANDROID_ID'),
        'to' => env('FCM_TEST_IOS_ID'),
    ]));
    $client = new GuzzleHttp\Client();
    $promise = $client->sendAsync($request)->then(function ($response) {
        echo $response->getBody();
    });
    $promise->wait();
});
