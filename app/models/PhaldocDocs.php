<?php

class PhaldocDocs extends \Phalcon\Mvc\Model
{

	public $id;
	public $lang_id;
	public $part_id;
	public $title;
	public $value;
	public $status;

	public function getSource()
	{
		return 'phaldoc_docs';
	}

}
