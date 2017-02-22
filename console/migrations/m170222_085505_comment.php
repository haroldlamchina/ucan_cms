<?php
/**
 * create table comment
 * by haroldlam
 *
 *
 * CREATE TABLE IF NOT EXISTS `comment` (
    `id` int(11) NOT NULL,
    `content` text COLLATE utf8_unicode_ci NOT NULL,
    `status` int(11) NOT NULL,
    `create_time` int(11) DEFAULT NULL,
    `userid` int(11) NOT NULL,
    `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
    `url` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
    `post_id` int(11) NOT NULL
    ) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
 */


use yii\db\Migration;

class m170222_085505_comment extends Migration
{
    const  UCAN_TBL='{{%comment}}';
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::UCAN_TBL, [
            'id' => $this->primaryKey(),
            'content' => $this->text()->notNull(),
            'status' => $this->integer(11)->notNull(),
            'create_time' => $this->integer(11)->defaultValue(null),
            'userid' => $this->integer(11)->notNull(),
            'email' => $this->string()->notNull(),
            'url' => $this->string(128)->defaultValue(null),
            'post_id' => $this->integer(11)->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        /*echo "m170222_085505_comment cannot be reverted.\n";

        return false;*/
        $this->dropTable(self::UCAN_TBL);
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
