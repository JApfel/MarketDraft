<?php

	use Phalcon\Mvc\Model;
	
	class Leagues extends Model	{
		
		public $id, $admin_id, $name, $created_at, $updated_at;
		
		function beforeValidationOnCreate()	{
			$this->disableChecks();
		}
		
		function beforeValidationOnUpdate()	{
			$this->disableChecks();
		}
		
		function disableChecks()	{
			$metaData = $this->getModelsMetaData();
			$attributes = $metaData->getNotNullAttributes($this);

			foreach($attributes as $field) {
				if(!($this->{$field})) {
					$this->{$field} = new Phalcon\Db\RawValue('default');
				}
			}
		}
		
		function initialize()	{
			$this->hasMany('id', 'Leagues', 'lid');
		}
	}
?>