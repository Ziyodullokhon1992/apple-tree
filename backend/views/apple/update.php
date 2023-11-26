<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Apple */

$this->title = 'Update Apple: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Apples', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="apple-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
