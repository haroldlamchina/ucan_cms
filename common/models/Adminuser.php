<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%adminuser}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $nickname
 * @property string $password
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Post[] $posts
 */
class Adminuser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%adminuser}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'nickname', 'password', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'nickname', 'password'], 'string', 'max' => 128],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common/adminuser', 'ID'),
            'username' => Yii::t('common/adminuser', 'Username'),
            'nickname' => Yii::t('common/adminuser', 'Nickname'),
            'password' => Yii::t('common/adminuser', 'Password'),
            'auth_key' => Yii::t('common/adminuser', 'Auth Key'),
            'password_hash' => Yii::t('common/adminuser', 'Password Hash'),
            'password_reset_token' => Yii::t('common/adminuser', 'Password Reset Token'),
            'email' => Yii::t('common/adminuser', 'Email'),
            'status' => Yii::t('common/adminuser', 'Status'),
            'created_at' => Yii::t('common/adminuser', 'Created At'),
            'updated_at' => Yii::t('common/adminuser', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['author_id' => 'id']);
    }
}
