<?php namespace Phaldoc;

class Projects extends \Phaldoc\Api {

    public $model = 'Projects';

    public function add($project, $describe = '', $version = '')
    {
        $this->params(
            array("project", "describe", "version"),
            array($project, $describe, $version)
        );
        $id = $this->create();

        if(!empty($id)){
            return $id;
        }
    }

    public function save($project, $describe, $version)
    {
        return $this->params(
            array("project", "describe", "version"),
            array($project, $describe, $version)
        )->update();
    }
}