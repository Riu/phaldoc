<?php namespace Phaldoc\Models;

class Files extends \Phaldoc\Model
{
	public $id;
	public $project_id;
	public $parent_id;
	public $is_parent;
	public $ordinal;
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
