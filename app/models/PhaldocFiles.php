<?php

class PhaldocFiles extends \Phalcon\Mvc\Model
{
	public $id;
	public $parent_id;
	public $ordinal;
	public $type;
	public $rst;

	public function getSource()
	{
		return 'phaldoc_files';
	}

}
