<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "apple".
 *
 * @property int $id
 * @property string $color
 * @property int $created_date
 * @property int|null $fallen_date
 * @property string $status
 * @property float $remained
 */
class Apple extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apple';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color', 'created_date'], 'required'],
            [['created_date', 'fallen_date'], 'integer'],
            [['remained'], 'number'],
            [['color'], 'string', 'max' => 6],
            [['status'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Color',
            'created_date' => 'Created Date',
            'fallen_date' => 'Fallen Date',
            'status' => 'Status',
            'remained' => 'Remained',
        ];
    }
}
