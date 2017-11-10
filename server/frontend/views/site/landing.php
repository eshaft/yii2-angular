<?php

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\LandingForm */
/* @var $form ActiveForm */

$this->title = "Landing";
$this->registerAssetBundle(\frontend\assets\LandingAsset::className());
?>
<div class="site-landing">

    <div class="row">
        <div class="col-lg-3">
            <?php Pjax::begin();
            $form = ActiveForm::begin([
                'options' => ['data' => ['pjax' => true]],
                'enableAjaxValidation' => false,
                'validateOnBlur' => false
            ]); ?>

            <?= $form->field($model, 'name')->textInput(['id' => 'name-1']) ?>
            <?= $form->field($model, 'phone')
                ->widget(\yii\widgets\MaskedInput::className(), [
                    'mask' => $model->getPhoneMask(),
                    'options' => ['id' => 'phone-1']
                ])->textInput(['id' => 'phone-1']) ?>

            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end();
            Pjax::end();?>
        </div>
        <div class="col-lg-3">
            <?php Pjax::begin();
            $form = ActiveForm::begin([
                'options' => ['data' => ['pjax' => true]],
                'enableAjaxValidation' => false,
                'validateOnBlur' => false
            ]); ?>

            <?= $form->field($model, 'name')->textInput(['id' => 'name-2']) ?>
            <?= $form->field($model, 'phone')
                ->widget(\yii\widgets\MaskedInput::className(), [
                    'mask' => $model->getPhoneMask(),
                    'options' => ['id' => 'phone-2']
                ])->textInput(['id' => 'phone-2']) ?>

            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end();
            Pjax::end();?>
        </div>
    </div>



</div><!-- site-landing -->