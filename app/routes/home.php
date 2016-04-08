<?php

$app->get('/', function ($request, $response, $args) use ($app) {
    return $this->view->render($response, 'home.html', [
        'message' => $app->getContainer()->flash->getMessage('message')[0]
    ]);
})->add($guest)->setName('home');
