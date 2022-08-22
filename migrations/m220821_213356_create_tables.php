<?php

use yii\db\Migration;
use app\models\Country;
use app\models\State;
use app\models\City;

/**
 * Class m220821_213356_create_tables
 */
class m220821_213356_create_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('country', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);

        $this->createTable('state', [
            'id' => $this->primaryKey(),
            'contry_id' => $this->integer(),
            'name' => $this->string(),
        ]);
        $this->createTable('city', [
            'id' => $this->primaryKey(),
            'state_id' => $this->integer(),
            'name' => $this->string(),
        ]);

        $data = [
            'Ukraine' => [
                'Poltavskaya' => [
                    'Poltava',
                    'Kremenchuk',
                ],
                'Dnepropetrovskaya' => [
                    'Dnepr',
                    'Pavlograd',
                ],
            ],
            'Russia' => [
                'Kurskaya' => [
                    'Kursk',
                    'Prima',
                ],
                'Novgorodskaya' => [
                    'Novgorod',
                    'Tereshkovka',
                ],
            ],
        ];

        foreach ($data as $countryName => $states) {
            $country = new Country();
            $country->name = $countryName;
            $country->save();

            foreach ($states as $stateName => $cities) {
                $state = new State();
                $state->name = $stateName;
                $state->contry_id = $country->id;
                $state->save();

                foreach ($cities as $cityName) {
                    $city = new City();
                    $city->name = $cityName;
                    $city->state_id = $state->id;
                    $city->save();
                }
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('country');
        $this->dropTable('state');
        $this->dropTable('city');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220821_213356_create_tables cannot be reverted.\n";

        return false;
    }
    */
}
