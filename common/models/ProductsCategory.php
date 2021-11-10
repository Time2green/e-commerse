<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%products_category}}".
 *
 * @property int $id
 * @property string|null $category
 */
class ProductsCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%products_category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category'], 'string', 'max' => 80],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Category',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ProductsCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ProductsCategoryQuery(get_called_class());
    }
}
