<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\groupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\helpers\Url;
?>


<!--<div class="mailtemplates-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>-->
<h3>Mail Templates</h3>

<br/>
<?php 
$gridColumn = [
    [
        'label' => 'ID',
        'attribute' => 'id',
    ],
    'name',
    'description',
    'subject',
    [
        'label' => 'Edit',
        'format' => 'raw',
        'value' => 
        function($model, $key, $index, $column) {
            return 
            Html::a(
                'Edit',
                Url::to(['user/update', 'id' => $model->id]), 
                [
                    'id'=>'grid-custom-button',
                    'action'=>Url::to(['default/update', 'id' => $model->id]),
                    'class'=>'button btn btn-warning',
                ]

            );
        }
    ],
]; 
?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumn,
]); ?>