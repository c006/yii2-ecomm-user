<?php
namespace c006\user\models\form;

use c006\email\WidgetEmailer;
use c006\user\models\User;
use Yii;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequest extends Model
{

    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
             'targetClass' => 'common\models\User',
             'filter'      => ['status' => User::STATUS_ACTIVE],
             'message'     => 'There is no user with such email.',
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
                                  'status' => User::STATUS_ACTIVE,
                                  'email'  => $this->email,
                              ]);

        if ($user) {
            if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
            }

            if ($user->save()) {
                $array = [];
                $array['subject'] = Yii::$app->params['siteName'] . ' : Password Reset';
                $array['token'] = $user->password_reset_token;
                $array['email_to'] = $user->email;
                $array['first_name'] = $user->first_name;

                return WidgetEmailer::widget(['template_id' => 5, 'array' => $array]);
            } else {
                print_r($user->getErrors());
                exit;
            }
        }

        return FALSE;
    }
}
