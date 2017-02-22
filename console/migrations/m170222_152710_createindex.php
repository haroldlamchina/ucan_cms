<?php

use yii\db\Migration;

class m170222_152710_createindex extends Migration
{
    public function safeUp()
    {
        //create index/key
        $this->addColumn('post','status','integer(11) not null');
        $this->createIndex('FK_comment_post','comment','post_id');
        $this->createIndex('FK_comment_user','comment','userid','user','id');
        $this->createIndex('FK_comment_status','comment','status');
        $this->createIndex('FK_post_author','post','author_id');
        $this->createIndex('FK_post_status','post','status');

        //create foreignkey
        $this->addForeignKey('FK_comment_post','comment','post_id','post','id');
        $this->addForeignKey('FK_comment_user','comment','userid','user','id');
        $this->addForeignKey('FK_comment_status','comment','status','commentstatus','id');
        $this->addForeignKey('FK_post_author','post','author_id','adminuser','id');
        $this->addForeignKey('FK_post_status','post','status','poststatus','id');



    }

    public function down()
    {
        $this->dropTable(self::UCAN_TBL);
        /*echo "m170222_152710_createindex cannot be reverted.\n";

        return false;*/
    }

/*--
-- Indexes for table `adminuser`
--
ALTER TABLE `adminuser`
ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
ADD PRIMARY KEY (`id`), ADD KEY `FK_comment_post` (`post_id`), ADD KEY `FK_comment_user` (`userid`), ADD KEY `FK_comment_status` (`status`);

--
-- Indexes for table `commentstatus`
--
ALTER TABLE `commentstatus`
ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
ADD PRIMARY KEY (`version`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
ADD PRIMARY KEY (`id`), ADD KEY `FK_post_author` (`author_id`), ADD KEY `FK_post_status` (`status`);

--
-- Indexes for table `poststatus`
--
ALTER TABLE `poststatus`
ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminuser`
--
ALTER TABLE `adminuser`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT for table `commentstatus`
--
ALTER TABLE `commentstatus`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `poststatus`
--
ALTER TABLE `poststatus`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- 限制导出的表
--

--
-- 限制表 `comment`
--
ALTER TABLE `comment`
ADD CONSTRAINT `FK_comment_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_comment_status` FOREIGN KEY (`status`) REFERENCES `commentstatus` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_comment_user` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- 限制表 `post`
--
ALTER TABLE `post`
ADD CONSTRAINT `FK_post_author` FOREIGN KEY (`author_id`) REFERENCES `adminuser` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_post_status` FOREIGN KEY (`status`) REFERENCES `poststatus` (`id`) ON DELETE CASCADE;*/

}
