<?php namespace Doc\Controllers;

class IndexController extends \Phaldoc\BaseController
{
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