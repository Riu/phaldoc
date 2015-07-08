<?php namespace Phaldoc\Models;

class Translates extends \Phaldoc\Model
{
    public $id;
    public $line_id;
    public $lang;
    public $translate;
    public $updated;
    public $status;

    public function initialize()
    {
        parent::initialize();
        $this->useDynamicUpdate(true);
    }

    public function getSource()
    {
        return 'phaldoc_translates';
    }
}