<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%locations}}`.
 */
class m220815_192102_create_locations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%locations}}', [
            'location_id ' => $this->primaryKey(),
            'zip_code' => $this->string(),
            'city' => $this->string(),
            'province' => $this->string(),
        ]);
        // creates index for column `author_id`
        $this->createIndex(
            'idx-locations-zip_code',
            'locations',
            'zip_code'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%locations}}');
    }
}
