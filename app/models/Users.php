<?php

	use Phalcon\Mvc\Model;
	
	class Users extends Model	{
		
		public $id, $fname, $lname, $email, $password, $salt, $online, $status, $image, $timezone, $created_at, $updated_at;
		
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
		
		function verify($password)	{
			if(md5($this->salt . $password) == $this->password)	{
				return true;
			}
			else	{
				return false;
			}
		}
		
		function initialize()	{
			$this->hasMany('id', 'Reviews', 'uid', array(
				'foreignKey' => array(
					'action' => Phalcon\Mvc\Model\Relation::ACTION_CASCADE
				)
			));
			$this->hasMany('id', 'Payments', 'uid', array(
				'foreignKey' => array(
					'action' => Phalcon\Mvc\Model\Relation::ACTION_CASCADE
				)
			));
		}
	}
?>