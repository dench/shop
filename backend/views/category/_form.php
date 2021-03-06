<?php

use common\helpers\CategoryList;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <ul class="nav nav-tabs">
        <?php foreach (\common\models\Language::suffixList() as $suffix => $name) : ?>
            <li<?php if (empty($suffix)) echo ' class="active"'; ?>><a href="#lang<?= $suffix ?>" data-toggle="tab"><?= $name ?></a></li>
        <?php endforeach; ?>
    </ul>
    <div class="tab-content">
        <?php foreach (\common\models\Language::suffixList() as $suffix => $name) : ?>
            <div class="tab-pane fade<?php if (empty($suffix)) echo ' in active'; ?>" id="lang<?= $suffix ?>">
                <?= $form->field($model, 'name' . $suffix)->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'title' . $suffix)->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'keywords' . $suffix)->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'description' . $suffix)->textarea() ?>
                <?= $form->field($model, 'text' . $suffix)->textarea() ?>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if ($model->id != 1) : ?>
    <?= $form->field($model, 'parent_id')->dropDownList(CategoryList::listTree(), ['options' => [$model->id => ['disabled' => true]]]) ?>
    <?php endif; ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput() ?>

    <?= $form->field($model, 'enabled')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
