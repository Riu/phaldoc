<?php

class PhaldocParts extends \Phalcon\Mvc\Model
{

	public $id;
	public $file_id;
	public $ordinal;
	public $type;
	public $is_tree;
	public $updated;

	public function initialize()
	{

		$this->skipAttributesOnCreate(array('id'));
		$this->useDynamicUpdate(true);
	}

	public function getSource()
	{
		return 'phaldoc_parts';
	}


	public function beforeUpdate()
	{
		$this->updated = time();
	}

}
