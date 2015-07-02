<?php namespace Doc\Controllers;

class ProjectsController extends \Phaldoc\BaseController
{
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