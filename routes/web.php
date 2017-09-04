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

$app->get('/test', function () {
    $request = new \GuzzleHttp\Psr7\Request('POST', 'https://fcm.googleapis.com/fcm/send', [
        'Content-Type' => 'application/json',
        'Authorization' => 'key=AAAAOAl_8L0:APA91bHe1HBVyM1Bq9ZtvUUBds4vjTFI7gDETRmUaqmyPY-VapuS0_nTaaG3QJPGNdhMRNzXlJR8oIAIq7YeTmdZ8y85Qf2qqZoYQjB9Y9Q0UaIQ-qrVXWaCSSED1-0TOP0ibFnr5sKf',
    ], json_encode([
        'data' => [
            'lat' => 15,
            'lon' => 15,
        ],
        'to' => 'c0UP7Zz7MXQ:APA91bFswI_4pfq-KLbH5WeREj8-Sge5IR5cbEU1wKrm2_O9g2Cgwt1CJLU2fJjlNZUwlXLktkeFfPGrO2nh5ZSPt9-1ttlFhrBt0-QhBoZnSK5SCBXS_3Z9PcZPCizo3YeJ9vS3bc6x',
    ]));
    $client = new GuzzleHttp\Client();
    $promise = $client->sendAsync($request)->then(function ($response) {
        echo $response->getBody();
    });
    $promise->wait();
});
