<?php
namespace c006\user\models\form;

use c006\alerts\Alerts;
use c006\user\models\User;
use Yii;
use yii\base\Model;

/**
 * Login form
 */
class Login extends Model
{

    public $email;

    public $password;

    public $rememberMe = 0;

    private $_user = FALSE;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params     the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect email or password.');
            }
        }
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === FALSE) {
            $this->_user = User::findByemail($this->email);
            if (isset($this->_user->status) && !$this->_user->status) {
                $this->_user = -1;
            }
        }

        return $this->_user;
    }

    /**
     * Logs in a user using the provided email and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), 0);
        } else {
            return FALSE;
        }
    }
}
