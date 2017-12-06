<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>

<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h3>
				<?php
				echo ($template->isNewRecord ? 'Create Mail Template' : 'Update Mail Template')
				?>
			</h3>
            <?php $form = ActiveForm::begin([
                'options' => [
                    'id' => 'template_form'
                 ],
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'enableAjaxValidation' => true
                ],
            ]) ?>
            <?= $form->field($template, 'id')->hiddenInput()->label(false) ?>
            <?= $form->field($template, 'subject') ?>

            <?= $form->field($template, 'body')->textArea(['rows' => '7', 'id' => 'template_body']) ?>
            <div id="validation_error" style="display: none; color:#FF0000;"></div>
            <br/><br/>
            
            
            
            <?= Html::submitButton($template->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $template->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id' => 'submit_button']) ?>
            <?php $form->end() ?>
        </div>
        <div class="col-md-4" style="margin-top: 7%;">
            <?php
            if(isset($template_constants))
            {
                echo 'Note : Double click on the constant keys to directly add it to editor.';
                echo '<table class="table table-bordered">';
                    echo '<thead>';
                    echo '<th style="background-color:#d3d3d3"><p>Constant Keys</p></th>';
                    echo '<th><p>Description</p></th>';
                    echo '</thead>';
                    echo '<tbody>';
                    foreach ($template_constants as $key => $value) {
                        echo '<tr class="key_value">';
                        echo '<td style="background-color:#d3d3d3">{{'.$value['name'].'}}</td>';
                        echo '<td><p>'.$value['description'].'</p></td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                echo '</table>';
                
            }
            ?>
        </div>
	</div>
</div>
<script type="text/javascript">
    CKEDITOR.replace( 'MailTemplate[body]' ,
    {   
        allowedContent: true,
        enterMode : CKEDITOR.ENTER_BR,
        shiftEnterMode: CKEDITOR.ENTER_P
    }).on('key',
        function(e){
            var data = e.editor.getData();
            $('#template_body').val(data);
        }
    );
    $('.key_value').dblclick(function(e){
        var name = $(this).children().html();
        CKEDITOR.instances['template_body'].insertText(name);
    });
    $('#submit_button').on('click', function(e){

        var keys = [];
        $('.key_value').each(function(){
             keys.push($(this).children().html());
        });
        var text_keys = getWordsBetweenCurlies(CKEDITOR.instances['template_body'].getData());
        var all_check = [];
        var wrong_keys = '';
        $.each( text_keys, function( index, value ){

            var check = 'false';
            $.each( keys, function( index1, value1 ){
                if('{{'+value+'}}' == value1)
                {
                    check = 'true';
                }
            }); 
            if(check == 'true')
            {
                all_check.push('true');
            }
            else
            {
                all_check.push('false');
                if(wrong_keys == '')
                {
                    wrong_keys +='{{'+value+'}}';
                }
                else
                {
                    wrong_keys +=', {{'+value+'}}';
                }
                
            }

        });

        $.each(all_check, function( index2, value2 ){
            if(value2 == 'false')
            {
                $('#validation_error').html('You have wrongly entered '+wrong_keys +' key(s). Please use allocated constant keys only, ');
                $('#validation_error').show();
                e.preventDefault();
            }
        });                 
        
    });


    function getWordsBetweenCurlies(str) {
      var results = [], re = /{{([^}]+)}}/g, text;

      while(text = re.exec(str)) {
        results.push(text[1]);
      }
      return results;
    }
</script>