<?php namespace Doc\Controllers;

class IndexController extends \Phaldoc\BaseController
{

    protected function initialize()
    {
        parent::initialize();
        $this->appendTitle('','b_index_title');
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