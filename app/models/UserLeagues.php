<?php

	use Phalcon\Mvc\Model;
	
	class UserLeagues extends Model	{
		
		public $id, $uid, $lid, $created_at, $updated_at;
		
		function beforeValidationOnCreate()	{
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
			$this->belongsTo('uid', 'Users', 'id', array(
                "foreignKey" => true
            ));
            $this->belongsTo('lid', 'Leagues', 'id', array(
                "foreignKey" => true
            ));
		}
	}
?>