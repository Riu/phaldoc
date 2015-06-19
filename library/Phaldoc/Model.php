<?php namespace Phaldoc;

class Model extends \Phalcon\Mvc\Model
{
    public function initialize()
    {
        $this->setConnectionService('db');
    }
}
