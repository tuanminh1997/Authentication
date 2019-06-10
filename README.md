# III.DocTrine & Database
# 1.Doctrine
### Generating a Twig Extension
bin/console make:twig-extension

### Installing KnpTimeBundle
composer require knplabs/knp-time-bundle

### delete data table
bin/console doctrine:query:sql "TRUNCATE TABLE article"

### Installing DoctrineFixturesBundle
composer require orm-fixtures --dev

### Generating Fixture with make:fixtures and load fixtures
bin/console make:fixtures
bin/console doctrine:fixtures:load

### Install faker
composer require fzaninotto/faker --dev
*@var Generator*

### StofDoctrineExtensionsBundle
https://symfony.com/doc/master/bundles/StofDoctrineExtensionsBundle/index.html
composer require stof/doctrine-extensions-bundle >p
*@Gedmo\Slug("fields={title}")*
*@Gedmo\Timestampable(on="update/create")*

config > pakeges >stof_doctrine_extensions.yaml

    stof_doctrine_extensions:
        default_locale: en_US
        orm:
             default:
                 sluggable: true
                timestampable: true


# 2.Database
### drop database
bin/console doctrine:database:drop --force

# 2 Mastering doctrine
### Paginator
https://github.com/KnpLabs/KnpPaginatorBundle
    
create file config/packages/knp_paginator.yaml 

    knp_paginator:
        template:
            pagination: '@KnpPaginator/Pagination/twitter_bootstrap_v4_pagination.html.twig'
