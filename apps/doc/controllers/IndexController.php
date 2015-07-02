<?php namespace Doc\Controllers;

class IndexController extends \Phaldoc\BaseController
{

    protected function initialize()
    {
        parent::initialize();
        $title = $this->i18n->_('b_index_title');
        \Phalcon\Tag::appendTitle(" - ".$title);
        $this->breadcrumb->add('',$title);
    }    

    public function indexAction()
    {

    }

    public function lgAction()
    {
        $lg = $this->dispatcher->getParam('lg');
        $this->session->set('lg',$lg);
        $this->response->redirect("");
    }
}