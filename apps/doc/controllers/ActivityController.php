<?php namespace Doc\Controllers;

class ActivityController extends \Phaldoc\BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $title = $this->i18n->_('activity_title');
        \Phalcon\Tag::appendTitle(" - ".$title);
        $this->breadcrumb->add('activity',$title);
    }    

    public function indexAction()
    {

    }
}