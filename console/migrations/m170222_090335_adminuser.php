<?php
/**
 * create table adminuser
 * by haroldlam
 */
use yii\db\Migration;

class m170222_090335_adminuser extends Migration
{
    /*CREATE TABLE IF NOT EXISTS `adminuser` (
    `id` int(11) NOT NULL,
    `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
    `nickname` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
    `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
    `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
    `profile` text COLLATE utf8_unicode_ci
    ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;*/
    const  UCAN_TBL='{{%adminuser}}';
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::UCAN_TBL, [
            'id' => $this->primaryKey(),
            'username' => $this->string(128)->notNull()->unique(),
            'nickname' =>$this->string(128)->notNull(),
            'password' =>$this->string(128)->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable(self::UCAN_TBL);
        /*echo "m170222_090335_adminuser cannot be reverted.\n";

        return false;*/
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
