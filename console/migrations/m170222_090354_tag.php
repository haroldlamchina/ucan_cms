<?php
/**
 * create table tag
 * by haroldlam
 *
 * CREATE TABLE IF NOT EXISTS `tag` (
    `id` int(11) NOT NULL,
    `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
    `frequency` int(11) DEFAULT '1'
    ) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
 */
use yii\db\Migration;

class m170222_090354_tag extends Migration
{
    const  UCAN_TBL='{{%tag}}';
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
            'frequency' => $this->integer(11)->defaultValue(1),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable(self::UCAN_TBL);
        /*echo "m170222_090354_tag cannot be reverted.\n";

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
