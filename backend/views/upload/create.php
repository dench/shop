<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Upload */

$this->title = Yii::t('backend', 'Create Upload');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Uploads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="upload-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
