<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminuserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Adminusers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adminuser-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend', 'Create Adminuser'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'nickname',
            //'auth_key',
            //'password_hash',
            // 'password_reset_token',
            'email:email',
            // 'status',
            // 'created_at',
            // 'updated_at',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {resetpwd} {privilege}',
                'buttons'=>[
                    'resetpwd'=>function($url,$model,$key)
                    {
                        $options=[
                            'title'=>Yii::t('backend','resetpassword'),
                            'aria-label'=>Yii::t('backend','resetpassword'),
                            'data-pjax'=>'0',
                        ];
                        return Html::a('<span class="glyphicon glyphicon-lock"></span>',$url,$options);
                    },

                    'privilege'=>function($url,$model,$key)
                    {
                        $options=[
                            'title'=>Yii::t('backend','Role permission'),
                            'aria-label'=>Yii::t('backend','Role permission'),
                            'data-pjax'=>'0',
                        ];
                        return Html::a('<span class="glyphicon glyphicon-user"></span>',$url,$options);
                    },

                ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
