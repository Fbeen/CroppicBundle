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

## How to use

todo

