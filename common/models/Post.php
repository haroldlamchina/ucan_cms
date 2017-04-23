<?php

namespace common\models;

use Yii;
use yii\helpers\html;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $author_id
 * @property integer $status
 *
 * @property Comment[] $comments
 * @property Poststatus $status0
 * @property Adminuser $author
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    private $_oldTags;
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'author_id', 'status'], 'required'],
            [['content', 'tags'], 'string'],
            [['create_time', 'update_time', 'author_id', 'status'], 'integer'],
            [['title'], 'string', 'max' => 128],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => Poststatus::className(), 'targetAttribute' => ['status' => 'id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Adminuser::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common/post', 'ID'),
            'title' => Yii::t('common/post', 'Title'),
            'content' => Yii::t('common/post', 'Content'),
            'tags' => Yii::t('common/post', 'Tags'),
            'create_time' => Yii::t('common/post', 'Create Time'),
            'update_time' => Yii::t('common/post', 'Update Time'),
            'author_id' => Yii::t('common/post', 'Author ID'),
            'status' => Yii::t('common/post', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id']);
    }

    public function getActiveComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id'])
            ->where('status=:status',[':status'=>2])->orderBy('id DESC');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(Poststatus::className(), ['id' => 'status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Adminuser::className(), ['id' => 'author_id']);
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if($insert)
            {
                $this->create_time = time();
                $this->update_time = time();
            }
            else
            {
                $this->update_time = time();
            }

            return true;

        }
        else
        {
            return false;
        }
    }


    public function afterFind()
    {
        parent::afterFind();
        $this->_oldTags = $this->tags;
    }

    public function afterSave($insert, $changedAttributes)
    {   /*echo 1111;
        print_r($changedAttributes);
        echo  12222;
        print_r($insert);
        echo 3333;
        print_r($this->_oldTags);
        echo 44444;
        print_r($this->tags);exit;*/
        parent::afterSave($insert, $changedAttributes);
        Tag::updateFrequency($this->_oldTags, $this->tags);
    }

    public function afterDelete()
    {
        parent::afterDelete();
        Tag::updateFrequency($this->tags, '');
    }

    public function getUrl()
    {
        return Yii::$app->urlManager->createUrl(
            ['post/detail','id'=>$this->id,'title'=>$this->title]);
    }

    public function getBeginning($length=288)
    {
        $tmpStr = strip_tags($this->content);
        $tmpLen = mb_strlen($tmpStr);

        $tmpStr = mb_substr($tmpStr,0,$length,'utf-8');
        return $tmpStr.($tmpLen>$length?'...':'');
    }

    public function  getTagLinks()
    {
        $links=array();
        foreach(Tag::string2array($this->tags) as $tag)
        {
            $links[]=Html::a(Html::encode($tag),array('post/index','PostSearch[tags]'=>$tag));
        }
        return $links;
    }

    public function getCommentCount()
    {
        return Comment::find()->where(['post_id'=>$this->id,'status'=>2])->count();
    }

}
