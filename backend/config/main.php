<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')
);

$config = [
    'id' => 'football-backend',
    'defaultRoute' => 'main/default/index',
    'language'=>'ru',
    'basePath' => dirname(__DIR__),
    'layoutPath' => '@app/modules/main/views/layouts',
    'viewPath' => '@app/modules/main/views',
    'aliases' => [
        '@img' => '../../common/uploads/teamEmblem/',
    ],
    'modules' => [
        'games' => [
            'class' => 'backend\modules\games\games'
        ],
        'main' => [
            'class' => 'backend\modules\main\main',
        ],
        'team' => [
            'class' => 'backend\modules\team\team',
        ],
        'players' => [
            'class' => 'backend\modules\players\players',
        ],
        'message' => [
            'class' => 'backend\modules\message\message',
        ],
        'cup' => [
            'class' => 'backend\modules\cup\cup',
        ],
    ],
    'components' => [
        'urlManager' => [
            'rules' => [
                //all
                '<_m:(main|games|team|players|message|cup)>' => '<_m>/default/index',
                //main
                '<team>/<_r:(allcancel)>' => 'main/default/<_r>',
                //team
                '<team>/<_r:(add|delete|edit|view|coach|index)>' => 'team/default/<_r>',
                //players
                '<players>/<_r:(new|del|change|current)>' => 'players/default/<_r>',
                //message
                '<message>/<_r:(addnews|views|remove|changes)>' => 'message/default/<_r>',
                //games
                '<games>/<_r:(match|removematch|changematch|anons|preview|score|select|rezult|addscore|listplayer|cancelscore)>' => 'games/default/<_r>',
                //cup
                '<cup>/<_r:(cupstat|cancelcupstat)>' => 'cup/default/<_r>',



            ]
        ],
        'request' => [
            'enableCookieValidation' => false,
            'enableCsrfValidation' => false,
            'baseUrl' => ''
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'main/default/error',
        ],
    ],
    'params' => $params,
];
if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
