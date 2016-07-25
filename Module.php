<?php
namespace c006\user;

use Yii;

/**
 * Class Module
 *
 * @package c006\user
 */
class Module extends \yii\base\Module
{

    /**
     * @var string
     */
    public $controllerNamespace = 'c006\user\controllers';

    /**
     * @var
     */
    public $identityClass;

    /**
     * @var bool
     */
    public $isBackend = FALSE;

    /**
     * @var string
     */
    public $loginPath = '/account/dashboard';

    /**
     *
     */
    public function init()
    {
        parent::init();

    }

    public function isBackend()
    {
        return $this->isBackend;
    }


    /**
     * Override createController()
     *
     * @link https://github.com/yiisoft/yii2/issues/810
     * @link http://www.yiiframework.com/forum/index.php/topic/21884-module-and-url-management/
     */
    public function createController($route)
    {
        preg_match('/(default)/', $route, $match);
        if (isset($match[0]))
            return parent::createController($route);
        $this->defaultRoute = (!$this->defaultRoute || $this->defaultRoute == 'default') ? 'user' : $this->defaultRoute;
        if (sizeof(explode('/', $route)) > 1) {
            list($this->defaultRoute, $route) = explode('/', $route);
        }

        return parent::createController("{$this->defaultRoute}/{$route}");
    }
}
