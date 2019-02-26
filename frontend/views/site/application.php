<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Подача заявки в систему поиска заявок пользователей';
?>
<div class="site-application">
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-application']); ?>

            <?= $form->field($model, 'fullName')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'text')->textarea() ?>

            <?= $form->field($model, 'city')->textInput() ?>

            <?= $form->field($model, 'address')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Подать заявку', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
