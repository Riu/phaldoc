<?php

class PhaldocParts extends \Phalcon\Mvc\Model
{

	public $id;
	public $file_id;
	public $parent_id;
	public $ordinal;
	public $type;

	public function getSource()
	{
		return 'phaldoc_parts';
	}

}
