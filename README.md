# III.DocTrine & Database
#1.Doctrine
###Generating a Twig Extension
bin/console make:twig-extension

###Installing KnpTimeBundle
composer require knplabs/knp-time-bundle

###delete data table
bin/console doctrine:query:sql "TRUNCATE TABLE article"

###Installing DoctrineFixturesBundle
composer require orm-fixtures --dev

###Generating Fixture with make:fixtures and load fixtures
bin/console make:fixtures
bin/console doctrine:fixtures:load

###Install faker
composer require fzaninotto/faker --dev
*@var Generator*

###StofDoctrineExtensionsBundle
https://symfony.com/doc/master/bundles/StofDoctrineExtensionsBundle/index.html
composer require stof/doctrine-extensions-bundle >p
*@Gedmo\Slug("fields={title}")*
*@Gedmo\Timestampable(on="update/create")*


#2.Database
###drop database
bin/console doctrine:database:drop --force


