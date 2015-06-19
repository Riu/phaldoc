<?php namespace Phaldoc\Models;

class Projects extends \Phaldoc\Model
{
    public $id;
    public $project;
    public $describe;
    public $version;

    public function initialize()
    {
        parent::initialize();
        $this->useDynamicUpdate(true);
    }

    public function getSource()
    {
        return 'phaldoc_projects';
    }
}
