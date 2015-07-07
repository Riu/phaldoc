<?php namespace Phaldoc;

class Files extends \Phaldoc\Api {

    public $model = 'Files';

    public function add($project_id, $parent_id, $is_parent, $ordinal, $rst)
    {
        $this->params(
            array("project_id", "parent_id", "is_parent", "ordinal", "rst"),
            array($project_id, $parent_id, $is_parent, $ordinal, $rst)
        );
        $id = $this->create();

        if(!empty($id)){
            return $id;
        }
    }

    public function save($project_id, $parent_id, $is_parent, $ordinal, $rst)
    {
        return $this->params(
            array("project_id", "parent_id", "is_parent", "ordinal", "rst"),
            array($project_id, $parent_id, $is_parent, $ordinal, $rst)
        )->update();
    }
}