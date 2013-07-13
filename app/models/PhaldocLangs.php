<?php

class PhaldocLangs extends \Phalcon\Mvc\Model
{

	public $id;
	public $lang;
	public $langname;

	public function getSource()
	{
		return 'phaldoc_langs';
	}
}
