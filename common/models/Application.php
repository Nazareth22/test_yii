<?php
/**
 * Created by PhpStorm.
 * User: MVYaroslavcev
 * Date: 26/02/19
 * Time: 11:58
 */

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Application model
 *
 * @property integer $id
 * @property string $full_name
 * @property string $text
 * @property string $city
 * @property string $address
 * @property float $lat
 * @property float $lon
 */
class Application extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%application}}';
    }


}