<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/22
 * Time: 16:38
 */
namespace console\controllers;

use yii\console\Controller;
use common\models\user;

class InitController extends Controller
{
    /**
     * Create init user
     */
    public function actionUser()
    {
        echo "Create init user ...\n";                  // 提示当前操作
        $username = $this->prompt('User Name:');        // 接收用户名
        $email = $this->prompt('Email:');               // 接收Email
        $password = $this->prompt('Password:');         // 接收密码
        $model = new User();                            // 创建一个新用户
        $model->username = $username;                   // 完成赋值
        $model->email = $email;
        $model->password = $password;
        $model->generateAuthKey();                     //自动创建auth_key
        if (!$model->save())                            // 保存新的用户
        {
            foreach ($model->getErrors() as $error)     // 如果保存失败，说明有错误，那就输出错误信息。
            {
                foreach ($error as $e)
                {
                    echo "$e\n";
                }
            }
            return 1;                                   // 命令行返回1表示有异常
        }
        echo "Create user sucessfull!\n";
        return 0;                                       // 返回0表示一切OK
    }


    /**
     * Create init adminuser
     */
    public function actionAdminuser()
    {
        echo "Create init adminuser ...\n";                  // 提示当前操作
        $username = $this->prompt('adminuser Name:');        // 接收用户名
        $email = $this->prompt('Email:');               // 接收Email
        $password = $this->prompt('Password:');         // 接收密码
        $model = new User();                            // 创建一个新用户
        $model->username = $username;                   // 完成赋值
        $model->email = $email;
        $model->password = $password;
        $model->generateAuthKey();                     //自动创建auth_key
        if (!$model->save())                            // 保存新的用户
        {
            foreach ($model->getErrors() as $error)     // 如果保存失败，说明有错误，那就输出错误信息。
            {
                foreach ($error as $e)
                {
                    echo "$e\n";
                }
            }
            return 1;                                   // 命令行返回1表示有异常
        }
        echo "Create adminuser sucessfull!\n";
        return 0;                                       // 返回0表示一切OK
    }
}