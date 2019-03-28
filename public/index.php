<?php

// Подключение автозагрузки через composer
require __DIR__ . '/../vendor/autoload.php';

// Вывод ошибок на экран (для удобной отладки)
$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$app = new \Slim\App($configuration);

// Контейнеры в этом курсе не рассматриваются (это тема связанная с самим ООП), но если вам интересно, то посмотрите DI Container
$container = $app->getContainer();
// Параметром передается базовая директория в которой будут храниться шаблоны
$container['renderer'] = new \Slim\Views\PhpRenderer(__DIR__ . '/../templates');

$app->get('/users/{id}', function ($request, $response, $args) {
    $params = ['id' => $args['id']];
    // Указанный путь считается относительно базовой директории для шаблонов, заданной на этапе конфигурации
    // $this доступен внутри анонимной функции благодаря http://php.net/manual/ru/closure.bindto.php
    return $this->renderer->render($response, 'users/show.phtml', $params);
});


$app->get('/', function ($request, $response) {
    return $response->write('Welcome to Slim!');
});
$app->run();
