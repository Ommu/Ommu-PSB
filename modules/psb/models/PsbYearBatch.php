<?php
/**
 * PsbYearBatch * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contact (+62)856-299-4114
 *
 * This is the template for generating the model class of a specified table.
 * - $this: the ModelCode object
 * - $tableName: the table name for this class (prefix is already removed if necessary)
 * - $modelClass: the model class name
 * - $columns: list of table columns (name=>CDbColumnSchema)
 * - $labels: list of attribute labels (name=>label)
 * - $rules: list of validation rules
 * - $relations: list of relations (name=>relation declaration)
 *
 * --------------------------------------------------------------------------------------
 *
 * This is the model class for table "ommu_psb_year_batch".
 *
 * The followings are the available columns in table 'ommu_psb_year_batch':
 * @property string $batch_id
 * @property string $year_id
 * @property string $batch_name
 * @property string $batch_start
 * @property string $batch_finish
 * @property integer $registers
 * @property string $creation_date
 * @property string $creation_id
 * @property string $modified_date
 * @property string $modified_id
 *
 * The followings are the available model relations:
 * @property OmmuPsbRegisters[] $ommuPsbRegisters
 * @property OmmuPsbYears $year
 */
class PsbYearBatch extends CActiveRecord
{
	public $defaultColumns = array();
	
	// Variable Search
	public $year_search;
	public $creation_search;
	public $modified_search;

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PsbYearBatch the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ommu_psb_year_batch';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('year_id, batch_name, batch_start, batch_finish', 'required'),
			array('registers', 'numerical', 'integerOnly'=>true),
			array('year_id, creation_id, modified_id', 'length', 'max'=>11),
			array('batch_name, batch_start, batch_finish, registers, creation_date, creation_id, modified_date, modified_id', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('batch_id, year_id, batch_name, batch_start, batch_finish, registers, creation_date, creation_id, modified_date, modified_id,
				year_search, creation_search, modified_search', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'registers' => array(self::HAS_MANY, 'PsbRegisters', 'batch_id'),
			'year_relation' => array(self::BELONGS_TO, 'PsbYears', 'year_id'),
			'creation_relation' => array(self::BELONGS_TO, 'Users', 'creation_id'),
			'modified_relation' => array(self::BELONGS_TO, 'Users', 'modified_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'batch_id' => 'Batch',
			'year_id' => 'Year',
			'batch_name' => 'Batch Name',
			'batch_start' => 'Batch Start',
			'batch_finish' => 'Batch Finish',
			'registers' => 'Registers',
			'creation_date' => 'Creation Date',
			'creation_id' => 'Creation',
			'modified_date' => 'Modified Date',
			'modified_id' => 'Modified',
			'year_search' => 'Year',
			'creation_search' => 'Creation',
			'modified_search' => 'Modified',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$currentAction = strtolower(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);

		$criteria=new CDbCriteria;

		$criteria->compare('t.batch_id',$this->batch_id,true);
		if(isset($_GET['year'])) {
			$criteria->compare('t.year_id',$_GET['year']);
		} else {
			if($currentAction == 'year/edit' && isset($_GET['id']))
				$criteria->compare('t.year_id',$_GET['id']);
			else				
				$criteria->compare('t.year_id',$this->year_id);
		}
		$criteria->compare('t.batch_name',$this->batch_name,true);
		if($this->batch_start != null && !in_array($this->batch_start, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.batch_start)',date('Y-m-d', strtotime($this->batch_start)));
		if($this->batch_finish != null && !in_array($this->batch_finish, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.batch_finish)',date('Y-m-d', strtotime($this->batch_finish)));
		$criteria->compare('t.registers',$this->registers);
		if($this->creation_date != null && !in_array($this->creation_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.creation_date)',date('Y-m-d', strtotime($this->creation_date)));
		$criteria->compare('t.creation_id',$this->creation_id,true);
		if($this->modified_date != null && !in_array($this->modified_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.modified_date)',date('Y-m-d', strtotime($this->modified_date)));
		$criteria->compare('t.modified_id',$this->modified_id,true);
		
		// Custom Search
		$criteria->with = array(
			'year_relation' => array(
				'alias'=>'year_relation',
				'select'=>'years'
			),
			'creation_relation' => array(
				'alias'=>'creation_relation',
				'select'=>'displayname'
			),
			'modified_relation' => array(
				'alias'=>'modified_relation',
				'select'=>'displayname'
			),
		);
		$criteria->compare('year_relation.years',strtolower($this->year_search), true);
		$criteria->compare('creation_relation.displayname',strtolower($this->creation_search), true);
		$criteria->compare('modified_relation.displayname',strtolower($this->modified_search), true);

		if(!isset($_GET['PsbYearBatch_sort']) && $currentAction != 'year/edit')
			$criteria->order = 'batch_id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>30,
			),
		));
	}


	/**
	 * Get column for CGrid View
	 */
	public function getGridColumn($columns=null) {
		if($columns !== null) {
			foreach($columns as $val) {
				/*
				if(trim($val) == 'enabled') {
					$this->defaultColumns[] = array(
						'name'  => 'enabled',
						'value' => '$data->enabled == 1? "Ya": "Tidak"',
					);
				}
				*/
				$this->defaultColumns[] = $val;
			}
		} else {
			//$this->defaultColumns[] = 'batch_id';
			$this->defaultColumns[] = 'year_id';
			$this->defaultColumns[] = 'batch_name';
			$this->defaultColumns[] = 'batch_start';
			$this->defaultColumns[] = 'batch_finish';
			$this->defaultColumns[] = 'registers';
			$this->defaultColumns[] = 'creation_date';
			$this->defaultColumns[] = 'creation_id';
			$this->defaultColumns[] = 'modified_date';
			$this->defaultColumns[] = 'modified_id';
		}

		return $this->defaultColumns;
	}

	/**
	 * Set default columns to display
	 */
	protected function afterConstruct() {
		if(count($this->defaultColumns) == 0) {
			/*
			$this->defaultColumns[] = array(
				'class' => 'CCheckBoxColumn',
				'name' => 'id',
				'selectableRows' => 2,
				'checkBoxHtmlOptions' => array('name' => 'trash_id[]')
			);
			*/
			$this->defaultColumns[] = array(
				'header' => 'No',
				'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
			);
			$this->defaultColumns[] = array(
				'name' => 'year_search',
				'value' => '$data->year_relation->years',
			);
			$this->defaultColumns[] = array(
				'name' => 'batch_name',
				'value' => 'ucwords($data->batch_name)',
			);
			$this->defaultColumns[] = array(
				'name' => 'batch_start',
				'value' => 'Utility::dateFormat($data->batch_start)',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter' => Yii::app()->controller->widget('zii.widgets.jui.CJuiDatePicker', array(
					'model'=>$this,
					'attribute'=>'batch_start',
					'language' => 'ja',
					'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
					//'mode'=>'datetime',
					'htmlOptions' => array(
						'id' => 'batch_start_filter',
					),
					'options'=>array(
						'showOn' => 'focus',
						'dateFormat' => 'dd-mm-yy',
						'showOtherMonths' => true,
						'selectOtherMonths' => true,
						'changeMonth' => true,
						'changeYear' => true,
						'showButtonPanel' => true,
					),
				), true),
			);
			$this->defaultColumns[] = array(
				'name' => 'batch_finish',
				'value' => 'Utility::dateFormat($data->batch_finish)',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter' => Yii::app()->controller->widget('zii.widgets.jui.CJuiDatePicker', array(
					'model'=>$this,
					'attribute'=>'batch_finish',
					'language' => 'ja',
					'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
					//'mode'=>'datetime',
					'htmlOptions' => array(
						'id' => 'batch_finish_filter',
					),
					'options'=>array(
						'showOn' => 'focus',
						'dateFormat' => 'dd-mm-yy',
						'showOtherMonths' => true,
						'selectOtherMonths' => true,
						'changeMonth' => true,
						'changeYear' => true,
						'showButtonPanel' => true,
					),
				), true),
			);
			$this->defaultColumns[] = array(
				'header' => 'registers',
				'value' => 'CHtml::link($data->registers, Yii::app()->controller->createUrl("admin/manage",array("batch"=>$data->batch_id)))',
				'type' => 'raw',
			);
			$this->defaultColumns[] = array(
				'name' => 'creation_search',
				'value' => '$data->creation_relation->displayname',
			);
			$this->defaultColumns[] = array(
				'name' => 'creation_date',
				'value' => 'Utility::dateFormat($data->creation_date)',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter' => Yii::app()->controller->widget('zii.widgets.jui.CJuiDatePicker', array(
					'model'=>$this,
					'attribute'=>'creation_date',
					'language' => 'ja',
					'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
					//'mode'=>'datetime',
					'htmlOptions' => array(
						'id' => 'creation_date_filter',
					),
					'options'=>array(
						'showOn' => 'focus',
						'dateFormat' => 'dd-mm-yy',
						'showOtherMonths' => true,
						'selectOtherMonths' => true,
						'changeMonth' => true,
						'changeYear' => true,
						'showButtonPanel' => true,
					),
				), true),
			);
		}
		parent::afterConstruct();
	}

	/**
	 * User get information
	 */
	public static function getInfo($id, $column=null)
	{
		if($column != null) {
			$model = self::model()->findByPk($id,array(
				'select' => $column
			));
			return $model->$column;
			
		} else {
			$model = self::model()->findByPk($id);
			return $model;			
		}
	}

	/**
	 * before validate attributes
	 */
	protected function beforeValidate() {
		if(parent::beforeValidate()) {
			$this->batch_start = date('Y-m-d', strtotime($this->batch_start));
			$this->batch_finish = date('Y-m-d', strtotime($this->batch_finish));
			if($this->isNewRecord) {
				$this->creation_id = Yii::app()->user->id;	
			} else {
				$this->modified_id = Yii::app()->user->id;					
			}
			if($this->batch_start >= $this->batch_finish)
				$this->addError('batch_finish', 'Batch Finish harus lebih besar dari Batch Start');
		}
		return true;
	}
	
	/**
	 * before save attributes
	 */
	protected function beforeSave() {
		if(parent::beforeSave()) {
			$this->batch_name = strtolower($this->batch_name);
			$this->batch_start = date('Y-m-d', strtotime($this->batch_start));
			$this->batch_finish = date('Y-m-d', strtotime($this->batch_finish));
		}
		return true;
	}

}