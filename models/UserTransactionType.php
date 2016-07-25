<?php

namespace c006\user\models;

use Yii;

/**
 * This is the model class for table "user_transaction_type".
 *
 * @property integer $id
 * @property string  $name
 * @property string  $css
 */
class UserTransactionType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_transaction_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['css'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'   => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'css'  => Yii::t('app', 'Css'),
        ];
    }
}
