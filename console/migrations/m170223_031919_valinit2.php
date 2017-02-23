<?php

use yii\db\Migration;

class m170223_031919_valinit2 extends Migration
{
    public function safeUp()
    {

        /*$res=$this->db->createCommand()
         ->batchInsert('comment',['id', 'content','status', 'create_time', 'userid', 'email', 'url', 'post_id'],
                      [
                       [88, '假设你想通过 RESTful 风格的 API 来展示用户数据。用户数据被存储在用户DB表， 你已经创建了 yii\\db\\ActiveRecord 类 app\\models\\User 来访问该用户数据.', 2, 1443004317, 1, 'sxb@hotmail.com', '', 41],
                       [89, 'yii\\db\\Query::one() 方法只返回查询结果当中的第一条数据， 条件语句中不会加上 LIMIT 1 条件。如果你清楚的知道查询将会只返回一行或几行数据 （例如， 如果你是通过某些主键来查询的），这很好也提倡这样做。但是，如果查询结果 有机会返回大量的数据时，那么你应该显示调用 limit(1) 方法，以改善性能。 例如， (new \\yii\\db\\Query())->from(\'user\')->limit(1)->one()。', 2, 1443004455, 1, 'somuchfun@gmail.com', '', 39],
                       [90, '传说中的沙发。', 2, 1443004561, 1, 'lsf@ggoc.com', '', 34],
                       [91, '当你在调用 yii\\db\\Query::all() 方法时，它将返回一个以连续的整型数值为索引的数组。 而有时候你可能希望使用一个特定的字段或者表达式的值来作为索引结果集数组。那么你可以在调用 yii\\db\\Query::all() 之前使用 yii\\db\\Query::indexBy() 方法来达到这个目的。', 2, 1443047988, 1, 'ctq@qq.com', '', 39],
                       [92, '如需使用表达式的值做为索引，那么只需要传递一个匿名函数给 yii\\db\\Query::indexBy() 方法即可', 2, 1443049673, 1, 'kiki@qq.com', '', 39],
                       [93, 'yii\\db\\Query::one() 方法只返回查询结果当中的第一条数据， 条件语句中不会加上 LIMIT 1 条', 2, 1443927141, 1, 'csc@bing.com', '', 39],
                       [94, '你应该在 响应格式 部分中过滤掉这些字段。', 1, 1444267750, 1, 'wj@163.com', 'www.wj.com', 41],
                       [95, '适合用常规格式显示一个模型（例如在一个表格的一行中显示模型的每个属性）。', 1, 1444377054, 1, 'tester@example.com', 'www.baidu.com', 36],
                      ]
                     )
         ->execute();
     无法插入文章之类的   因为存在 外键
     */
        $_inserttbale='commentstatus';
        $res=$this->db->createCommand()
            ->batchInsert($_inserttbale,
                ['id', 'name', 'position'],
                [
                    [1, '待审核', 1],
                    [2, '已审核', 2]
                ]
            )->execute();
        $this->defaultres($_inserttbale,$res);

         $_inserttbale='poststatus';
         $res=$this->db->createCommand()
             ->batchInsert($_inserttbale,
                 ['id', 'name', 'position'],
                 [
                     [1, '草稿', 1],
                     [2, '已发布', 2],
                     [3, '已归档', 3],
                 ]
             )->execute();
         $this->defaultres($_inserttbale,$res);



    }

    public function safeDown()
    {
        $this->delete('commentstatus');
        $this->delete('poststatus');
        /*echo "m170223_031919_valinit2 cannot be reverted.\n";

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
    /** echo error
     * @param string $_inserttbale
     * @param int $res
     */
    public function defaultres($_inserttbale='',$res=1){
        if(!$res){
            echo "$_inserttbale default value failed.\n";
        }

    }
}
