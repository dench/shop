<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\bootstrap\ActiveForm */

if ($model->isNewRecord) {
    $inputTemplate = '{input}';
} else {
    $inputTemplate = <<<HTML
    <div class="input-group">
        {input}
        <span class="input-group-btn">
            <button class="modelValue btn btn-default" type="button"><i class="glyphicon glyphicon-refresh"></i></button>
        </span>
    </div>
HTML;

    $urlModelValue = Url::to(['product/model-value']);
    $script = <<<JS
    $('.modelValue').click(function() {
        var obj = $(this).parents('.input-group').find('.form-control');
        if (obj.attr('disabled') || obj.attr('readonly')) {
            obj.prop('disabled', false);
            obj.prop('readonly', false);
        } else {
            $.get('{$urlModelValue}', { id: {$model->id}, name: obj.attr('name') }, function(data) {
                if (data) {
                    obj.val(data).prop('readonly', true);
                }
            });
        }
    });
JS;
    Yii::$app->view->registerJs($script, yii\web\View::POS_READY);
}
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <ul class="nav nav-tabs">
        <?php foreach (\common\models\Language::suffixList() as $suffix => $name) : ?>
            <li<?php if (empty($suffix)) echo ' class="active"'; ?>><a href="#lang<?= $suffix ?>" data-toggle="tab"><?= $name ?></a></li>
        <?php endforeach; ?>
    </ul>
    <div class="tab-content">
        <?php foreach (\common\models\Language::suffixList() as $suffix => $name) : ?>
            <div class="tab-pane fade<?php if (empty($suffix)) echo ' in active'; ?>" id="lang<?= $suffix ?>">

                <?= $form->field($model, 'name' . $suffix, ['inputTemplate' => $inputTemplate])
                    ->textInput(['maxlength' => true, 'disabled' => (isset($model->nullAttributes['name' . $suffix])) ? true : false]) ?>

                <?= $form->field($model, 'title' . $suffix, ['inputTemplate' => $inputTemplate])
                    ->textInput(['maxlength' => true, 'disabled' => (isset($model->nullAttributes['title' . $suffix])) ? true : false]) ?>

                <?= $form->field($model, 'keywords' . $suffix, ['inputTemplate' => $inputTemplate])->textInput(['maxlength' => true, 'disabled' => (isset($model->nullAttributes['keywords' . $suffix])) ? true : false]) ?>

                <?= $form->field($model, 'description' . $suffix, ['inputTemplate' => $inputTemplate])->textarea(['disabled' => (isset($model->nullAttributes['description' . $suffix])) ? true : false]) ?>

                <?= $form->field($model, 'text' . $suffix, ['inputTemplate' => $inputTemplate])->textarea(['disabled' => (isset($model->nullAttributes['text' . $suffix])) ? true : false]) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <?= $form->field($model, 'brand_id', ['inputTemplate' => $inputTemplate])
        ->dropDownList(\common\models\Brand::list(), ['disabled' => (isset($model->nullAttributes['brand_id'])) ? true : false]) ?>

    <?= $form->field($model, 'slug', ['inputTemplate' => $inputTemplate])
        ->textInput(['maxlength' => true, 'disabled' => (isset($model->nullAttributes['slug'])) ? true : false]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'old_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'currency_id')->dropDownList(\common\models\Currency::list()) ?>

    <?= $form->field($model, 'available')->textInput() ?>

    <?= $form->field($model, 'position')->textInput() ?>

    <?= $form->field($model, 'enabled')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
