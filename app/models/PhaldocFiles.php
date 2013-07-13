<?php

class PhaldocFiles extends \Phalcon\Mvc\Model
{
	public $id;
	public $ordinal;
	public $type;
	public $rst;

	public function getSource()
	{
		return 'phaldoc_files';
	}

}
