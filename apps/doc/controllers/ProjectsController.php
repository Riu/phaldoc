<?php namespace Doc\Controllers;

class ProjectsController extends \Phaldoc\BaseController
{

    protected function initialize()
    {
        parent::initialize();
        $title = $this->i18n->_('projects_title');
        \Phalcon\Tag::appendTitle(" - ".$title);
        $this->breadcrumb->add('projects',$title);
    }    

    public function indexAction()
    {
        $projects = \Phaldoc\Models\Projects::find();
        $this->view->setVar("projects", $projects);
    }

    public function addAction()
    {

    }

    public function viewAction()
    {

    }

    public function editAction()
    {

    }

    public function deleteAction()
    {

    }

}