<?php namespace Phaldoc\Models;

class Langs extends \Phaldoc\Model
{
	public $id;
	public $lang;
	public $langname;


	public function initialize()
	{
		$this->useDynamicUpdate(true);
	}

	public function getSource()
	{
		return 'phaldoc_langs';
	}

}
