<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "state".
 *
 * @property int $id
 * @property int|null $contry_id
 * @property string|null $name
 *
 * @property City[] $cities
 * @property Country $contry
 */
class State extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'state';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contry_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['contry_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['contry_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contry_id' => 'Contry ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Cities]].
     *
     * @return \yii\db\ActiveQuery|CityQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::className(), ['state_id' => 'id']);
    }

    /**
     * Gets query for [[Contry]].
     *
     * @return \yii\db\ActiveQuery|CountryQuery
     */
    public function getContry()
    {
        return $this->hasOne(Country::className(), ['id' => 'contry_id']);
    }

    /**
     * {@inheritdoc}
     * @return StateQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StateQuery(get_called_class());
    }
}
