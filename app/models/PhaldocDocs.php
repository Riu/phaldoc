<?php

class PhaldocDocs extends \Phalcon\Mvc\Model
{

	public $id;
	public $lang_id;
	public $part_id;
	public $title;
	public $value;
	public $status;
	public $updated;

	public function initialize()
	{

		$this->skipAttributesOnCreate(array('id'));
		$this->useDynamicUpdate(true);
	}

	public function getSource()
	{
		return 'phaldoc_docs';
	}

	public function beforeUpdate()
	{
		$this->updated = time();
	}

}
