
# Installation

This document will guide you through the process of installing Yii2-rbac using **composer**. Installation is a quick and
easy four-step process.

> **NOTE:** Before we start make sure that you have properly configured **db** application component.

## Step 1: Download using composer

Download extension using [composer](https://getcomposer.org):

```bash
composer require --prefer-dist derekisbusy/yii2-contact "*"
```

or add

```bash
"derekisbusy/yii2-contact": "*"
```

to the require section of your `composer.json` file then run `composer update`.


## Step 2: Configure your web application

Add contact manager module to web application config file.

If the project uses the Yii2 Advanced Project Template then add the following to the backend config.

```php
if (!defined('YII2_CONTACT_MODULE') {
    define('YII2_CONTACT_MODULE', 'contact');
}

...
'modules' => [
    ...
    YII2_CONTACT_MODULE => [
        'class' => 'derekisbusy\contact\backend\modules\contact\Module',
        'userSettings' => [
            ContactModule::USER_CLASS => 'common\models\User'
        ]
    ],
    ...
],
...
```

Then update the frontend config as follows:

```php
if (!defined('YII2_CONTACT_MODULE') {
    define('YII2_CONTACT_MODULE', 'contact');
}

...
'modules' => [
    ...
    YII2_CONTACT_MODULE => [
        'class' => 'derekisbusy\contact\frontend\modules\contact\Module',
        'viewSettings' => [
            ContactModule::VIEW_CONTACT => '@frontend/views/site/contact'
        ],
        'userSettings' => [
            ContactModule::USER_CLASS => 'common\models\User'
        ]
    ],
    ...
],
...
```

If the project uses the Yii2 Basic Application Template then add both the modules to the config 
but use different keys for both. For Example:

```php
if (!defined('YII2_CONTACT_MODULE') {
    define('YII2_CONTACT_MODULE', 'contact');
}
if (!defined('YII2_CONTACT_ADMIN_MODULE') {
    define('YII2_CONTACT_ADMIN_MODULE', 'contact-admin');
}
...
'modules' => [
    ...
    YII2_CONTACT_ADMIN_MODULE => [
        'class' => 'derekisbusy\contact\backend\modules\contact\Module',
        'userSettings' => [
            ContactModule::USER_CLASS => 'app\models\User'
        ]
    ],
    YII2_CONTACT_MODULE => [
        'class' => 'derekisbusy\contact\frontend\modules\contact\Module',
        'viewSettings' => [
            ContactModule::VIEW_CONTACT => '@frontend/views/site/contact'
        ],
        'userSettings' => [
            ContactModule::USER_CLASS => 'app\models\User'
        ]
    ],
    ...
],
...
```
You can copy the frontend views from the module into your sites views and edit them as needed or use the
default view.

## Step 3: Update your database schema

After you downloaded and configured Yii2-rbac, the last thing you need to do is updating your database schema by 
applying the migration:

```bash
$ php yii migrate/up --migrationPath=@vendor/derekisbusy/contact/migrations
```


## Step 4: Configure access control for admin module

This extension can be configured to work with either RBAC or basic access control. 

[Setup Basic Access Control](setup-basic-access-control.md)

[Setup RBAC](setup-rbac)
