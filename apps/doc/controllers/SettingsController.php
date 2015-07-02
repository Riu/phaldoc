<?php namespace Doc\Controllers;

class SettingsController extends \Phaldoc\BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $title = $this->i18n->_('settings_title');
        \Phalcon\Tag::appendTitle(" - ".$title);
        $this->breadcrumb->add('settings',$title);
    }    

    public function indexAction()
    {

    }
}