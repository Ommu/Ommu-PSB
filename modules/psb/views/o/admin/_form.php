<?php
/**
 * Psb Registers (psb-registers)
 * @var $this AdminController
 * @var $model PsbRegisters
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date 27 April 2016, 12:23 WIB
 * @link https://github.com/Ommu/Ommu-PSB
 * @contect (+62)856-299-4114
 *
 */
?>

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'id'=>'psb-registers-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

<?php //begin.Messages ?>
<div id="ajax-message">
	<?php echo $form->errorSummary($model); ?>
</div>
<?php //begin.Messages ?>

<fieldset>

	<?php if(!$model->isNewRecord ) {?>
	<div class="clearfix">
		<?php echo $form->labelEx($model,'status'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'status'); ?>
			<?php echo $form->error($model,'status'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>
	<?php }?>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'batch_id'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'batch_id',array('maxlength'=>11)); ?>
			<?php echo $form->error($model,'batch_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>
	
	<h3><?php echo Yii::t('phrase', 'Identitas Peserta Seleksi');?></h3>
	<div class="clearfix">
		<?php echo $form->labelEx($model,'register_name'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'register_name',array('maxlength'=>32)); ?>
			<?php echo $form->error($model,'register_name'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'nisn'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'nisn',array('maxlength'=>12)); ?>
			<?php echo $form->error($model,'nisn'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'birth_city'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'birth_city',array('maxlength'=>11)); ?>
			<?php echo $form->error($model,'birth_city'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'birth_date'); ?>
		<div class="desc">
			<?php
			!$model->isNewRecord ? ($model->birth_date != '0000-00-00' ? $model->birth_date = date('d-m-Y', strtotime($model->birth_date)) : '') : '';
			//echo $form->textField($model,'birth_date');
			$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				'model'=>$model,
				'attribute'=>'birth_date',
				//'mode'=>'datetime',
				'options'=>array(
					'dateFormat' => 'dd-mm-yy',
				),
				'htmlOptions'=>array(
					'class' => 'span-4',
				 ),
			)); ?>
			<?php echo $form->error($model,'birth_date'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'gender'); ?>
		<div class="desc">
			<?php echo $form->dropDownList($model,'gender',array(
				'male'=>Yii::t('phrase', 'Laki-laki'),
				'female'=>Yii::t('phrase', 'Perempuan'),
			)); ?>
			<?php echo $form->error($model,'gender'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<?php if($setting->field_religion == 1) {?>
		<div class="clearfix">
			<?php echo $form->labelEx($model,'religion'); ?>
			<div class="desc">
				<?php 
				$religion = PsbReligions::getReligion(1);
				if($religion != null)
					echo $form->dropDownList($model,'religion', $religion, array('prompt'=>Yii::t('phrase', 'Pilih salah satu')));
				else
					echo $form->dropDownList($model,'religion', array('prompt'=>Yii::t('phrase', 'Pilih salah satu')));?>
				<?php echo $form->error($model,'religion'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>
	<?php }?>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'address'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'address'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'address_phone'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'address_phone',array('maxlength'=>15)); ?>
			<?php echo $form->error($model,'address_phone'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'address_yogya'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'address_yogya',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'address_yogya'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'address_yogya_phone'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'address_yogya_phone',array('maxlength'=>15)); ?>
			<?php echo $form->error($model,'address_yogya_phone'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<h3><?php echo Yii::t('phrase', 'Identitas Orang Tua / Wali');?></h3>
	<div class="clearfix">
		<?php echo $form->labelEx($model,'parent_name'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'parent_name',array('maxlength'=>32)); ?>
			<?php echo $form->error($model,'parent_name'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'parent_work'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'parent_work',array('maxlength'=>32)); ?>
			<?php echo $form->error($model,'parent_work'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<?php if($setting->field_religion == 1) {?>
		<div class="clearfix">
			<?php echo $form->labelEx($model,'parent_religion'); ?>
			<div class="desc">
				<?php 
				$religion = PsbReligions::getReligion(1);
				if($religion != null)
					echo $form->dropDownList($model,'parent_religion', $religion, array('prompt'=>Yii::t('phrase', 'Pilih salah satu')));
				else
					echo $form->dropDownList($model,'parent_religion', array('prompt'=>Yii::t('phrase', 'Pilih salah satu')));?>
				<?php echo $form->error($model,'parent_religion'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>
	<?php }?>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'parent_address'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'parent_address',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'parent_address'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'parent_phone'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'parent_phone',array('maxlength'=>15)); ?>
			<?php echo $form->error($model,'parent_phone'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<?php if($setting->field_wali == 1) {?>
		<div class="clearfix">
			<?php echo $form->labelEx($model,'wali_name'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'wali_name',array('maxlength'=>32)); ?>
				<?php echo $form->error($model,'wali_name'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'wali_work'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'wali_work',array('maxlength'=>32)); ?>
				<?php echo $form->error($model,'wali_work'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<?php if($setting->field_religion == 1) {?>
			<div class="clearfix">
				<?php echo $form->labelEx($model,'wali_religion'); ?>
				<div class="desc">
					<?php 
					$religion = PsbReligions::getReligion(1);
					if($religion != null)
						echo $form->dropDownList($model,'wali_religion', $religion, array('prompt'=>Yii::t('phrase', 'Pilih salah satu')));
					else
						echo $form->dropDownList($model,'wali_religion', array('prompt'=>Yii::t('phrase', 'Pilih salah satu')));?>
					<?php echo $form->error($model,'wali_religion'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
			</div>
		<?php }?>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'wali_address'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'wali_address',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($model,'wali_address'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'wali_phone'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'wali_phone',array('maxlength'=>15)); ?>
				<?php echo $form->error($model,'wali_phone'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>
	<?php }?>

	<h3><?php echo Yii::t('phrase', 'Asal Sekolah');?></h3>
	<div class="clearfix">
		<?php echo $form->labelEx($model,'school_id'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'school_id',array('maxlength'=>11)); ?>
			<?php echo $form->error($model,'school_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<h3><?php echo Yii::t('phrase', 'Nilai Ujian Nasional / UASBN');?></h3>
	<div class="clearfix">
		<?php echo $form->labelEx($model,'school_un_rank'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'school_un_rank',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'school_un_rank'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>
	
	<?php if($setting->form_online == 1) {?>
	<h3><?php echo Yii::t('phrase', 'Author');?></h3>
	<div class="clearfix">
		<?php echo $form->labelEx($model,'author_id'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'author_id',array('maxlength'=>11)); ?>
			<?php echo $form->error($model,'author_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>
	<?php }?>

	<div class="submit clearfix">
		<label>&nbsp;</label>
		<div class="desc">
			<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('phrase', 'Create') : Yii::t('phrase', 'Save'), array('onclick' => 'setEnableSave()')); ?>
		</div>
	</div>

</fieldset>
<?php $this->endWidget(); ?>


