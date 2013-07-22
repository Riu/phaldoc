<?php

class PhaldocFiles extends \Phalcon\Mvc\Model
{
	public $id;
	public $parent_id;
	public $ordinal;
	public $type;
	public $is_parent;
	public $rst;

	public function initialize()
	{
		$this->useDynamicUpdate(true);
	}

	public function getSource()
	{
		return 'phaldoc_files';
	}

}
