<?php namespace Doc\Controllers;

class ProjectsController extends \Phaldoc\BaseController
{

    protected function initialize()
    {
        parent::initialize();
        $this->appendTitle('projects','projects_title');
    }    

    public function indexAction()
    {
        $projects = \Phaldoc\Models\Projects::find();
        $this->view->setVar("projects", $projects);
    }

    public function addAction()
    {
        $this->appendTitle('add','projects_add_title');
    }

    public function viewAction()
    {
        $this->appendTitle('view','projects_view_title');
    }

    public function editAction()
    {
        $this->appendTitle('edit','projects_edit_title');
    }

    public function deleteAction()
    {
        $this->appendTitle('delete','projects_delete_title');
    }

}