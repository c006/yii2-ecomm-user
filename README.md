Yii2 user
===================



Installation
------------


User `composer.json`


Composer.json
------------

>
    "repositories": [
        {
          "type": "vcs",
          "url": "https://github.com/c006/yii2-user.git"
        },
        {
          "type": "vcs",
          "url": "https://github.com/c006/yii2-email-templates.git"
        },
      ]
  
  
  
  
  
Setup
------------
  
>
    'modules'    => [
        'user'            => [
            'class'     => 'c006\user\Module',
            'loginPath' => '/account/dashboard',
        ],
    ],


**config/params.php**
>
            'siteName'          => 'My Site',
            'siteUrl'           => 'http://my-site.com',
            'user_verfiy_email' => TRUE,
            'user_login_path'   => '/account',
            
            
Requires
-----------


` php composer.phar require --prefer-dist "c006/yii2-alerts" "dev-master" `






Comments
---------

.

.

.

.

.

.

.
 
  
  
  
    
    

























