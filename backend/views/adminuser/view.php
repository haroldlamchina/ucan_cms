<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Adminuser */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Adminusers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adminuser-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'nickname',
            /*'auth_key',
            'password_hash',
            'password_reset_token',*/
            'email:email',
            //'status',
            [
                'attribute' => 'created_at',
                'format'=>['date','php:Y-m-d H:i'],
            ],
            [
                'attribute' => 'updated_at',
                'format'=>['date','php:Y-m-d H:i'],
            ]
        ],
    ]) ?>

</div>
