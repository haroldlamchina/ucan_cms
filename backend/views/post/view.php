<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content:ntext',
            'tags:ntext',
            [
                'attribute'=>'create_time',
                'value'=>date("Y-m-d H:i:s",$model->create_time),
            ],
            [
                'attribute'=>'update_time',
                'value'=>date("Y-m-d H:i:s",$model->update_time),
            ],
            [
                'attribute'=>'author_id',
                'value'=>$model->author->nickname,
            ],
            [
                'label'=>yii::t('common/post','Status'),
                'value'=>$model->status0->name,
            ],
        ],
    ]) ?>

</div>
