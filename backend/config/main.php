<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    /*'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            //'layout' => 'left-menu',//yii2-admin的导航菜单
        ],
    ],*/
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    //'userClassName' => 'common\models\User',
                    'userClassName' => 'common\models\Adminuser',
                    'idField' => 'id'
                ]
            ],
            'menus' => [
                'assignment' => [
                    'label' => 'Grand Access' // change label
                ],
                //'route' => null, // disable menu route
            ]
        ],
        'debug' => [
            'class' => 'yii\debug\Module',
        ],
    ],
    /*'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\Adminuser',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'request'=>[
            'cookieValidationKey'=>'sdfjjksloeedf78789judf',
            'csrfParam'=>'_adminCSRF',
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
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // 使用数据库管理配置文件
        ],

    ],*/
    'components' => [
        // 'user' => [//前台用户组件，后台用不到
        //     'identityClass' => 'common\models\User',
        //     'enableAutoLogin' => true,
        // ],
        'user' => [
            //管理员
            'class' => '\yii\web\User',
            'loginUrl' => array('/site/login'),//没有登录就跳转到
            'idParam'           => '_aId',
            'identityCookie'    => ['name'=>'_aa','httpOnly' => true],
            'identityClass' => 'common\models\Adminuser',
            'enableAutoLogin' => true,
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
            'errorAction' => 'site/error',
        ],
        //rdbc
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            //'defaultRoles' => ['guest'],
        ],
    ],
    'params' => $params,
    'aliases' => [
            '@mdm/admin' => '@vendor/mdmsoft/yii2-admin',
        ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        //'defaultRoles' => ['guest'],
        'allowActions' => [
            '*'
            /*'site/*',//允许访问的节点，可自行添加
            'admin/*',//允许所有人访问admin节点及其子节点*/
        ]
    ],
];
