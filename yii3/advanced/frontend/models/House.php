<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "house".
 *
 * @property integer $house_id
 * @property string $hoser_name
 * @property string $cart_name
 * @property integer $house_count
 * @property string $market_parice
 * @property string $house_desc
 * @property string $house_thumb
 * @property string $house_img
 * @property integer $in_sale
 * @property string $add_time
 * @property integer $house_sort
 * @property integer $is_delete
 * @property string $site
 */
class House extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'house';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hoser_name'], 'required'],
            [['house_count', 'in_sale', 'house_sort', 'is_delete'], 'integer'],
            [['market_parice'], 'number'],
            [['add_time'], 'safe'],
            [['hoser_name', 'site'], 'string', 'max' => 120],
            [['cart_name'], 'string', 'max' => 255],
            [['house_desc', 'house_thumb', 'house_img'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'house_id' => 'House ID',
            'hoser_name' => 'Hoser Name',
            'cart_name' => 'Cart Name',
            'house_count' => 'House Count',
            'market_parice' => 'Market Parice',
            'house_desc' => 'House Desc',
            'house_thumb' => 'House Thumb',
            'house_img' => 'House Img',
            'in_sale' => 'In Sale',
            'add_time' => 'Add Time',
            'house_sort' => 'House Sort',
            'is_delete' => 'Is Delete',
            'site' => 'Site',
        ];
    }

    public function upda($data,$where)
    {
        $res = $this->updateAll($data,$where);
        return $res;
    }
}
