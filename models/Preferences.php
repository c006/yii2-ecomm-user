<?php

namespace c006\user\models;

use Yii;

/**
 * This is the model class for table "preferences".
 *
 * @property integer $id
 * @property string $key
 * @property string $value
 * @property integer $editable
 */
class Preferences extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'preferences';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            [['editable'], 'integer'],
            [['key'], 'string', 'max' => 45],
            [['value'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'key' => Yii::t('app', 'Key'),
            'value' => Yii::t('app', 'Value'),
            'editable' => Yii::t('app', 'Editable'),
        ];
    }
}
