<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    //设置语言
    'language'=>'zh-CN',
    'timeZone'=>'Asia/Chongqing',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => \yii\rbac\DbManager::className(),
        ],
    ],
];
