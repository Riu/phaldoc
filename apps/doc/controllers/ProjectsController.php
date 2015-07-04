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
                $rec = \Categories\Categories::factory()
                    ->add($project, $describe, $version);

                $this->flashSession->success('Projekt został dodany.');
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
    }

    public function deleteAction()
    {
        $this->appendTitle('delete','projects_delete_title');
    }

}