<?php namespace Phaldoc;

class Langs extends \Phaldoc\Api {

    public $model = 'Langs';

    public function add($lang, $langname)
    {
        $this->params(
            array("lang", "langname"),
            array($lang, $langname)
        );
        $id = $this->create();

        if(!empty($id)){
            return $id;
        }
    }

    public function save($lang, $langname)
    {
        return $this->params(
            array("lang", "langname"),
            array($lang, $langname)
        )->update();
    }
}