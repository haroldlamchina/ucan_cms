<?php

namespace common\models;

use Yii;

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
}
