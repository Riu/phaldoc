<?php namespace Doc\Controllers;

class ActivityController extends \Phaldoc\BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->appendTitle('activity','activity_title');
    }    

    public function indexAction()
    {

    }
}