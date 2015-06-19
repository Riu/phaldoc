<?php namespace Doc\Controllers;

class ProjectsController extends \Phaldoc\BaseController
{
    public function indexAction()
    {
        $projects = \Phaldoc\Models\Projects::find();
        $this->view->setVar("projects", $projects);
    }
}