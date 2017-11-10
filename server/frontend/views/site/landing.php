<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\LandingForm */
/* @var $form ActiveForm */

$this->title = "Landing";
$this->params['breadcrumbs'][] = $this->title;
$this->registerAssetBundle(\frontend\assets\LandingAsset::className());
?>
<div class="site-landing">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <?php for($i = 1; $i <= 4; $i++): ?>
            <div class="col-lg-3">
                <div class="submit-success">
                    <span class="glyphicon glyphicon-send"></span>
                    <p>Your phone was sent!</p>
                </div>
                <div class="landing-form">
                    <?php Pjax::begin();
                    $form = ActiveForm::begin([
                        'options' => ['data' => ['pjax' => true]],
                        'enableAjaxValidation' => false,
                        'validateOnBlur' => false
                    ]); ?>

                    <?= $form->field($model, 'name')->textInput(['id' => "name-$i"]) ?>
                    <?= $form->field($model, 'phone')
                        ->widget(\yii\widgets\MaskedInput::className(), [
                            'mask' => $model->getPhoneMask(),
                            'options' => ['id' => "phone-$i"]
                        ])->textInput(['id' => "phone-$i"]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                    </div>
                    <?php ActiveForm::end();
                    Pjax::end();?>
                </div>
            </div>
        <?php endfor; ?>
    </div>

    <div class="row">
        <?php for($i = 5; $i <= 8; $i++): ?>
            <div class="col-lg-3">
                <?php
                Modal::begin([
                    'header' => '<h4>Send phone!</h4>',
                    'toggleButton' => [
                        'tag' => 'button',
                        'class' => 'btn btn-info',
                        'label' => 'Send phone!',
                    ]
                ]);
                ?>

                <div class="submit-success">
                    <span class="glyphicon glyphicon-send"></span>
                    <p>Your phone was sent!</p>
                </div>
                <div class="landing-form">
                    <?php Pjax::begin();
                    $form = ActiveForm::begin([
                        'options' => ['data' => ['pjax' => true]],
                        'enableAjaxValidation' => false,
                        'validateOnBlur' => false
                    ]); ?>

                    <?= $form->field($model, 'name')->textInput(['id' => "name-$i"]) ?>
                    <?= $form->field($model, 'phone')
                        ->widget(\yii\widgets\MaskedInput::className(), [
                            'mask' => $model->getPhoneMask(),
                            'options' => ['id' => "phone-$i"]
                        ])->textInput(['id' => "phone-$i"]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                    </div>
                    <?php ActiveForm::end();
                    Pjax::end();?>
                </div>

                <?php
                Modal::end();
                ?>
            </div>
        <?php endfor; ?>
    </div>



</div><!-- site-landing -->