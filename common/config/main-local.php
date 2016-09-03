<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=test_id20',
            'username' => 'bakhman_kate',
            'password' => '5CFu9WYRLBYYcA6f',
            'charset' => 'utf8',
            'enableSchemaCache' => true,            
            'schemaCacheDuration' => 3600, // Duration of schema cache            
            'schemaCache' => 'cache', // Name of the cache component used to store schema information
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',           
            'useFileTransport' => true,
        ],
        'i18n' => [
            'translations' => [
                'yii' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-US',
                    'basePath' => '@common/messages'
                ],
            ],
        ],
    ],
];
