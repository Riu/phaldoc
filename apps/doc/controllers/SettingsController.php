<?php namespace Doc\Controllers;

class SettingsController extends \Phaldoc\BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->appendTitle('settings','settings_title');
    }    

    public function indexAction()
    {

    }
}