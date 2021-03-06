<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%comment}}".
 *
 * @property integer $id
 * @property string $content
 * @property integer $status
 * @property integer $create_time
 * @property integer $userid
 * @property string $email
 * @property string $url
 * @property integer $post_id
 *
 * @property User $user
 * @property Commentstatus $status0
 * @property Post $post
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'status', 'userid', 'email', 'post_id'], 'required'],
            [['content'], 'string'],
            [['status', 'create_time', 'userid', 'post_id'], 'integer'],
            [['email'], 'string', 'max' => 255],
           //[['url'], 'string', 'max' => 128],
           // [['userid'], 'unique'],
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userid' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => Commentstatus::className(), 'targetAttribute' => ['status' => 'id']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common/comment', 'ID'),
            'content' => Yii::t('common/comment', 'Content'),
            'status' => Yii::t('common/comment', 'Status'),
            'create_time' => Yii::t('common/comment', 'Create Time'),
            'userid' => Yii::t('common/comment', 'Userid'),
            'email' => Yii::t('common/comment', 'Email'),
            'url' => Yii::t('common/comment', 'Url'),
            'post_id' => Yii::t('common/comment', 'Post ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(Commentstatus::className(), ['id' => 'status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    //截取字段
    public function getBeginning()
    {
        $tmpStr = strip_tags($this->content);
        $tmpLen = mb_strlen($tmpStr);

        return mb_substr($tmpStr,0,10,'utf-8').(($tmpLen>10)?'...':'');
    }
    //审核通过
    public function approve()
    {
        $this->status = 2; //设置评论状态为已审核
        return ($this->save()?true:false);
    }


    public static function getPengdingCommentCount()
    {
        return Comment::find()->where(['status'=>1])->count();
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if($insert)
            {
                $this->create_time=time();
            }
            return true;
        }
        else  return false;
    }

    public static function findRecentComments($limit=10)
    {
        return Comment::find()->where(['status'=>2])->orderBy('create_time DESC')
            ->limit($limit)->all();
    }


}
