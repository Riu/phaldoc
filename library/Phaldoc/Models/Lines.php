<?php namespace Phaldoc\Models;

class Lines extends \Phaldoc\Model
{
    public $id;
    public $file_id;
    public $ordinal;
    public $is_translate;
    public $is_empty;
    public $type;
    public $updated;

    public function initialize()
    {
        parent::initialize();
        $this->useDynamicUpdate(true);
    }

    public function getSource()
    {
        return 'phaldoc_lines';
    }
}