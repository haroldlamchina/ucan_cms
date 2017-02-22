<?php
/**
 * create table  commentstatus
 * by haroldlam
 *
 * CREATE TABLE IF NOT EXISTS `commentstatus` (
    `id` int(11) NOT NULL,
    `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
    `position` int(11) NOT NULL
    ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
 */
use yii\db\Migration;

class m170222_090252_commentstatus extends Migration
{

    const  UCAN_TBL='{{%commentstatus}}';
    public function up()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::UCAN_TBL, [
            'id' => $this->primaryKey(),
            'name' => $this->string(128)->notNull(),
            'position' => $this->integer(11)->notNull(),
        ], $tableOptions);
    }

    public function down()
    {

        $this->dropTable(self::UCAN_TBL);
        /*echo "m170222_090252_commentstatus cannot be reverted.\n";

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
