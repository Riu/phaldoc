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
        if ($this->request->isPost() == true) 
        {
            $project = $this->request->getPost("project", "striptags");
            $describe = $this->request->getPost("describe", "striptags");
            $version = $this->request->getPost("version", "striptags");

            
            $validation = new \Phaldoc\Validation();
            $validation->required('project',$this->i18n->_('validation_project_required'));
            $data = $validation->render($_POST);

            if($data['success'] == '1'){
                $rec = (new \Phaldoc\Projects)->add($project, $describe, $version);

                $this->flashSession->success($this->i18n->_('project_added'));
                return $this->response->redirect('projects');
            }
            else
            {
                $this->flashSession->error($data['errors'][0]['message']);
            }
        }
    }

    public function viewAction()
    {
        $this->appendTitle('view','projects_view_title');
    }

    public function editAction()
    {
        $this->appendTitle('edit','projects_edit_title');
        $paramid = $this->dispatcher->getParam('id');
        $record = (new \Phaldoc\Projects)->id($paramid);
        if ($this->request->isPost() == true) 
        {
            $project = $this->request->getPost("project", "striptags");
            $describe = $this->request->getPost("describe", "striptags");
            $version = $this->request->getPost("version", "striptags");

            
            $validation = new \Phaldoc\Validation();
            $validation->required('project',$this->i18n->_('validation_project_required'));
            $data = $validation->render($_POST);

            if($data['success'] == '1'){
                $rec = (new \Phaldoc\Projects)->id($paramid)->save($project, $describe, $version);

                $this->flashSession->success($this->i18n->_('validation_saved'));
                return $this->response->redirect('projects');
            }
            else
            {
                $this->flashSession->error($data['errors'][0]['message']);
            }
        }
        else{
            $this->view->setVar("project", $record->query);
            $this->tag->setDefault("id", $paramid);
            $this->tag->setDefault("project", $record->query->project);
            $this->tag->setDefault("describe", $record->query->describe);
            $this->tag->setDefault("version", $record->query->version);
        }
    }

    public function deleteAction()
    {
        $this->appendTitle('delete','projects_delete_title');
        $paramid = $this->dispatcher->getParam('id');
        $record = (new \Phaldoc\Projects)->id($paramid);
        if ($this->request->isPost() == true) 
        {
            $id = $this->request->getPost("id", "striptags");
            if($id === $paramid){
                $rec = (new \Phaldoc\Projects)->id($id)->delete();
                $this->flashSession->success($this->i18n->_('project_deleted'));
                return $this->response->redirect('projects');
            }
            else
            {
                $this->flashSession->error($this->i18n->_('project_notdeleted'));
            }
        }
        else{
            $this->view->setVar("project", $record->query);
            $this->tag->setDefault("id", $paramid);
        }
    }

}