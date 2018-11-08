yii2-z1user
========================
It is a module for user.
It use the [myzero1/yii2-theme-layui](https://github.com/myzero1/yii2-theme-layui) as it's theme.


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require-dev myzero1/yii2-z1user：*
```

or add

```
"myzero1/yii2-z1user": "*"
```

to the require-dev section of your `composer.json` file.


Setting
-----

Once the extension is installed, simply modify your application configuration as follows:

#### in main.php ####

```php
return [
    ......
    'modules' => [
        ......
        'z1userid' => [
            'class' => 'myzero1\z1user\Module',
        ],
        ......
    ],
    ......
];
```


Usage
-----

You can then access home page to watch the theme.

```
http://localhost/path/to/z1userid/z1-user
```

#### rewrite ####

* ` set rewrite `

see the rewriting of yii2-z1site.


LICENSE
-----
MIT