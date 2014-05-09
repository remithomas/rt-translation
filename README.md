rt-translation
============

ZF2 translations helper and manager

Features / Goals
============

* Manage translations
* view helpers

How to install ?
============
### Using composer.json

```json
{
    "name": "zendframework/skeleton-application",
    "description": "Skeleton Application for ZF2",
    "license": "BSD-3-Clause",
    "keywords": [
        "framework",
        "zf2"
    ],
    "minimum-stability": "dev",
    "homepage": "http://framework.zend.com/",
    "require": {
        "php": ">=5.3.3",
        "zendframework/zendframework": "dev-master",
        "remithomas/rt-translation": "dev-master"
    }
}
```

### Activate the module :

application.config.php
```php
<?php
return array(
    'modules' => array(
        'Application',
        'RtTranslation',
    )
);
?>
```



Roadmap
============

* Installer for translations and locales into database
* More view helpers