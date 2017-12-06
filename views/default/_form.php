<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>

<div class="container">
	<div class="row">
		<div class="col-md-12">
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
            <?= $form->field($template, 'template_code') ?>
            <?= $form->field($template, 'name') ?>
            <?= $form->field($template, 'description') ?>
            <?= $form->field($template, 'subject') ?>
            <?= $form->field($template, 'body')->textArea(['rows' => '7', 'id' => 'template_body']) ?>

            <button type="button" class="btn btn-success" id="btn_constant_add">Add Constant Keys +</button>
            <br/><br/>
            
            <div id="template_constants">
            	<?php
            	$count = 1;
            	if(isset($template_constants))
            	{
            		foreach ($template_constants as $key => $value) 
            		{
            			?>
            			<div class="row" style="margin-bottom:25px;" id="constant_row_<?php echo $count; ?>">
            				<div class="col-md-3">
            					<input type="text" name="constant_key[<?php echo $count; ?>]" value="<?php echo $value['name'];?>" class="constant_keys" size="20" placeholder="Constant Key">
            				</div>
            				<div class="col-md-4">
            					<input type="text" name="constant_desc[<?php echo $count; ?>]" value="<?php echo $value['description'];?>" class="constant_descriptions" size="40" placeholder="Constant Key Description">
            				</div>
            				<div class="col-md-2">
            					<button type="button" id="constant_delete_<?php echo $count; ?>" class="btn btn-danger constant_delete" title="Delete Constant Key">X</button>
            				</div>
            			</div>
            			<?php
            			$count++;
            		}
            	}
            	?>
            </div>
            <input type="hidden" id="constant_count" value="<?php echo $count; ?>">
            <br/><br/>
            <?= Html::submitButton($template->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $template->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id' => 'submit_button']) ?>
            <?php $form->end() ?>
        </div>
	</div>
</div>
<?php
// $this->registerJsFile('../vendor/tusharugale/yii2-mail-templates/assets/js/jquery_validate.js');
$search ="
	$('#btn_constant_add').click(function(e)
	{
		e.preventDefault();
		var count = parseInt($('#constant_count').val());
		$('#template_constants').append('<div class=\"row\" style=\"margin-bottom:25px;\" id=\"constant_row_'+count+'\"><div class=\"col-md-3\"><input type=\"text\" name=\"constant_key['+count+']\" class=\"constant_keys\" size=\"20\" placeholder=\"Constant Key\"></div><div class=\"col-md-4\"><input type=\"text\" name=\"constant_desc['+count+']\" size=\"40\"class=\"constant_descriptions\"  placeholder=\"Constant Key Description\"></div><div class=\"col-md-2\"><button type=\"button\" id=\"constant_delete_'+count+'\" class=\"btn btn-danger constant_delete\"   title=\"Delete Constant Key\">X</button></div></div>');
		$('#constant_count').val(count+1);
        
	});
	$('body').on('click','.constant_delete', function(e)
	{
		e.preventDefault();
		var count = $(this).attr('id').split('_');
		count = count[2];
		$('#constant_row_'+count).remove();
	});

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
    
    $('#submit_button').on('click', function(event){
        var regex = /^[a-zA-Z0-9_.-]+$/;
        
        $('.constant_keys').each(function(e){
            if($(this).val() == '')
            {
                $(this).next('p').remove();
                $(this).after('<p class=\"text-danger\">Constant Key cannot be empty</p>');
                event.preventDefault();
            }
            else
            {
                if(regex.test($(this).val()))
                {
                    $(this).next('p').remove();
                    
                } 
                else
                {
                    $(this).next('p').remove();
                    $(this).after('<p class=\"text-danger\">You can only use A-Z, a-z, 0-9, Underscore, and hyphen characters (Space are not allowed)</p>');
                    event.preventDefault();
                }
            }
            
        });
        $('.constant_descriptions').each(function(e){
            if($(this).val() == '')
            {
                $(this).next('p').remove();
                $(this).after('<p class=\"text-danger\">Constant Key Description cannot be empty</p>');
                event.preventDefault();
            }
            else
            {
                $(this).next('p').remove();
            }
        });

    });
   ";
$this->registerJs($search);
////$this->registerJsFile('../vendor/tusharugale/yii2-mail-templates/assets/js/jquery.js');
// $('.constant_key').each(function(){
//         $(this).rules('add', {
//            required: true,
//         });   
//     });
//$('#template_form').validate();
// $(function(){
//       $('#template_form').validate();
//       $('.constant_key').each(function(){
//          $(this).rules('add', {
//            required: true,
//          });   
//        });
//     });
// $("#template_form").validate({
        // rules: {
        //     'constant_key[]': {
        //         required: true
        //     }
        // },
        // submitHandler: function (e){   
        //     $('.constant_key').each(function(){
        //         // alert('asdasd');
        //         $(this).rules( "add", {
        //            required: true,
        //         });
        //     });
        // }
    // });
?>

