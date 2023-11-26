<?php

namespace common\models;

use Yii;
use yii\helpers\Html;

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
    const STATUS = [
        "ON_TREE" => "on_tree",
        "FALLEN" => "fallen",
        "BITTEN_OFF" => "bitten_off",
        "ROTTEN" => "rotten",
    ];

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

    public function getStatusLabel(): string
    {
        $statusLabels = self::statusLabels();
        $label = $statusLabels[$this->status];
        $statusName = ucfirst(str_replace('_', ' ', $this->status));
        return Html::tag('span', $statusName, ['class' => "label label-$label"]);
    }

    public static function statusNames(): array
    {
        return array_map(function (string $name): string {
            return ucfirst(str_replace('_', ' ', $name));
        }, array_flip(self::STATUS));
    }

    public static function statusLabels(): array
    {
        return [
            self::STATUS["ON_TREE"] => "success",
            self::STATUS["FALLEN"] => "info",
            self::STATUS["BITTEN_OFF"] => "warning",
            self::STATUS["ROTTEN"] => "danger",
        ];
    }
}
