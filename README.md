# V.Security 
### 1.bin/console make:user
composer require security

### login form 
*https://symfony.com/doc/current/security/form_login_setup.html*

# Form
###    Datetime
      ->add('publishedAt',null,[
         'widget'=>'single_text'
             ])

### single form
  {{ form_row(articleForm.title) }}             