<?php
namespace c006\user\models\form;

use Yii;
use yii\base\Model;

/**
 * Class Transactions
 *
 * @package c006\user\models\form
 */
class Transactions extends Model
{

    public $date_from;

    public $date_to;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['date_from', 'date', 'message' => 'Must be a valid date'],
            ['date_to', 'date', 'message' => 'Must be a valid date'],
        ];
    }

}
