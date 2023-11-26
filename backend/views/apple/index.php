<?php

use common\models\Apple;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel \common\models\search\AppleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Apples';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .color {
        width: 30px;
        height: 30px;
        box-shadow: 1px 2px 5px grey;
        border-radius: 20%;
        margin-top: 5px;
    }
</style>
<div class="apple-index box box-primary">
    <div style="margin: 10px">
        <button id="create-btn" class="btn btn-info" data-toggle="modal" data-target="#create-modal">
            Create apples
        </button>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                'id',
                [
                    'attribute' => 'color',
                    'format' => 'raw',
                    'value' => function (Apple $apple) {
                        return Html::tag('div', '', [
                            'class' => 'color',
                            'style' => "background-color: {$apple->color}"
                        ]);
                    }
                ],
                'created_date:datetime',
                'fallen_date:datetime',
                [
                    'attribute' => 'status',
                    'format' => 'raw',
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'status',
                        Apple::statusNames(),
                        ['prompt' => '', 'class' => 'form-control']
                    ),
                    'value' => function (Apple $apple) {
                        return $apple->getStatusLabel();
                    }
                ],
                'remained:percent',
                [
                    'class' => ActionColumn::class,
                    'template' => '{fall} {bite-off} {eat}',
                    'buttons' => [
                        'fall' => function (string $url, Apple $apple) {
                            if (!$apple->canFall()) {
                                return "";
                            }
                            $icon = "<span class='glyphicon glyphicon-download-alt'></span>";
                            return Html::a($icon, ["fall-form", "id" => $apple->id], ['data' => [
                                'toggle' => 'modal',
                                'target' => '#fall-modal',
                                'title' => 'Fall'
                            ]]);
                        },
                        'bite-off' => function (string $url, Apple $apple) {
                            if ($apple->canFall()) {
                                return "";
                            }
                            $icon = "<span class='glyphicon glyphicon-apple'></span>";
                            return Html::a($icon, ["bite-off-form", 'id' => $apple->id], ['data' => [
                                'toggle' => 'modal',
                                'target' => '#bite-off-modal',
                                'title' => 'Bite off'
                            ]]);
                        },
                        'eat' => function (string $url, Apple $apple) {
                            if ($apple->canFall()) {
                                return "";
                            }
                            $icon = "<span class='glyphicon glyphicon-trash'></span>";
                            return Html::a($icon, ["eat-form", 'id' => $apple->id], ['data' => [
                                'toggle' => 'modal',
                                'target' => '#eat-modal',
                                'title' => 'Eat'
                            ]]);
                        }
                    ],
                    'urlCreator' => function ($action, Apple $model, $key, $index, $column) {
                        $url = [$action, 'id' => $model->id];
                        return Url::toRoute($url);
                    }
                ]
            ]
        ]); ?>
    </div>
</div>

<div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Random number of apples will be created. Continue?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <form method="POST" action="<?= Url::to(["create"]); ?>">
                    <button type="submit" id="accept-create" class="btn btn-primary">
                        Yes
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="fall-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>
<div class="modal fade" id="bite-off-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>
<div class="modal fade" id="eat-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>