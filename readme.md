# FbeenCroppicBundle

This bundle supplies a image upload from the croppic project (http://www.croppic.net/) in Symfony

### Features include:

* very simple installation
* todo

## Installation

Using composer:

1) Add `"fbeen/croppicbundle": "dev-master"` to the require section of your composer.json project file.

```
    "require": {
        ...
        "fbeen/croppicbundle": "dev-master"
    },
```

2) run composer update:

    $ composer update

3) Add the bundle to the app/AppKernel.php:
```
        $bundles = array(
            ...
            new Fbeen\CroppicBundle\FbeenCroppicBundle(),
        );
```

4) Add Routes to app/config/routing.yml
```
    fbeen_croppic:
        resource: "@FbeenCroppicBundle/Resources/config/routing.yml"
        prefix:   /
```

5) Update the database 
```
    php app/console doctrine:schema:update --force
```

6) Add configuration to app/config/config.yml 
```
    fbeen_croppic:
        upload:
            filepath: "%kernel.root_dir%/../web"
            original: "/uploads/original"
            cropped: "/uploads/cropped"
```

7) Create directories
```
    cd web
    mkdir uploads
    cd uploads
    mkdir original
    mkdir cropped
```


## How to use

todo

