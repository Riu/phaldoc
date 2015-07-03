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
        $title = $this->i18n->_('projects_add_title');
        \Phalcon\Tag::appendTitle(" - ".$title);
        $this->breadcrumb->add('projects',$title);
    }

    public function viewAction()
    {
        $title = $this->i18n->_('projects_view_title');
        \Phalcon\Tag::appendTitle(" - ".$title);
        $this->breadcrumb->add('projects',$title);
    }

    public function editAction()
    {
        $title = $this->i18n->_('projects_edit_title');
        \Phalcon\Tag::appendTitle(" - ".$title);
        $this->breadcrumb->add('projects',$title);
    }

    public function deleteAction()
    {
        $title = $this->i18n->_('projects_delete_title');
        \Phalcon\Tag::appendTitle(" - ".$title);
        $this->breadcrumb->add('projects',$title);
    }

}