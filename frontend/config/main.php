<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')
);


$config = [
    'id' => 'football-frontend',
    'language'=>'ru',
    'defaultRoute'=>'main/default/index',
    'basePath' => dirname(__DIR__),
    'layoutPath' => '@app/modules/main/views/layouts',
    'aliases' => [
        '@img' => '@backend/web/uploads/teamEmblem',
    ],
    'modules' => [
            'cup' => [
                'class' => 'frontend\modules\cup\cup',
            ],
            'news' => [
                'class' => 'frontend\modules\news\news',
            ],
            'main' => [
                'class' => 'frontend\modules\main\main',
            ],
            'info' => [
                'class' => 'frontend\modules\info\info',
            ],
            'rezult' => [
                'class' => 'frontend\modules\rezult\rezult',
            ],
            'stat' => [
                'class' => 'frontend\modules\stat\stat',
            ],
    ],
    'components' => [
        'request' => [
            'enableCookieValidation' => false,
            'enableCsrfValidation' => false,
            'baseUrl' => ''
        ],
        'urlManager' => [
            'rules' => [

                '<_m:(main|news|rezult|stat|cup|info)>' => '<_m>/default/index',

            ]
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
