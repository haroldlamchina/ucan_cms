<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\poststatus;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend', 'Create Post'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            ['attribute'=>'id',
                'contentOptions'=>['width'=>'30px'],
            ],
            'title',
            //'content:ntext',
            ['attribute'=>'authorName',
                'label'=>Yii::t('backend','author'),
                'value'=>'author.nickname',
            ],
            'tags:ntext',
            //'create_time:datetime',
            // 'update_time:datetime',
            // 'author_id',
            // 'status',
            ['attribute'=>'status',
                'value'=>'status0.name',
                'filter'=>Poststatus::find()
                    ->select(['name','id'])
                    ->orderBy('position')
                    ->indexBy('id')
                    ->column(),
            ],
            ['attribute'=>'update_time',
                'format'=>['date','php:Y-m-d H:i:s'],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
