<?php
/*
 * create table post
 * by haroldlam
 *
 * CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `tags` text COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
 */
use yii\db\Migration;

class m170222_085524_post extends Migration
{

    const  UCAN_TBL='{{%post}}';
    public function up()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::UCAN_TBL, [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull(),
            'content' => $this->text()->notNull(),
            'tags' => $this->text(),
            'status'=>$this->integer(11)->notNull(),
            'create_time' => $this->integer(11)->defaultValue(null),
            'update_time' => $this->integer(11)->defaultValue(null),
            'author_id' => $this->integer(11)->notNull(),
        ], $tableOptions);

    }

    public function down()
    {

        $this->dropTable(self::UCAN_TBL);
        /*echo "m170222_085524_post cannot be reverted.\n";

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
