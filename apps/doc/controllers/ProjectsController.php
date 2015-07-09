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
        $paramid = $this->dispatcher->getParam('id');
        $this->view->setVar("paramid", $paramid);
        $project = (new \Phaldoc\Projects)->id($paramid);
        $this->view->setVar("project", $project->query);
        $files = \Phaldoc\Models\Files::find(array(
            "conditions" => "project_id = ".$paramid."",
            "order" => "ordinal ASC"
        ));
        $this->view->setVar("files", $files);
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

    // Managment of files in project

    public function deletefileAction()
    {
        $paramid = $this->dispatcher->getParam('id');
        $paramfid = $this->dispatcher->getParam('fid');
        $record = (new \Phaldoc\Projects)->id($paramid);
        $file = (new \Phaldoc\Files)->id($paramfid);
        $this->appendTitle('view/'.$record->query->id,$record->query->project);
        $this->appendTitle('deletefile','projects_deletefile_title');
        if ($this->request->isPost() == true) 
        {
            $id = $this->request->getPost("id", "striptags");
            $fid = $this->request->getPost("fid", "striptags");
            $parent = $this->request->getPost("parent", "striptags");
            if($id === $paramid && $fid === $paramfid){
                $rec = (new \Phaldoc\Files)->id($fid)->delete();
                if($rec){
                    $files = \Phaldoc\Models\Files::find(array(
                        "conditions" => "parent_id = '$parent' AND project_id = '$paramid'",
                        "order" => "ordinal ASC",
                    ));
                    $i = 1;
                    foreach($files as $f)
                    {
                        $f->ordinal = $i;
                        $f->update();
                        $i++;
                    }
                    $this->flashSession->success($this->i18n->_('project_deleted'));
                    return $this->response->redirect('projects');
                }
                else
                {
                    $this->flashSession->error($this->i18n->_('project_notdeleted'));
                }
            }
            else
            {
                $this->flashSession->error($this->i18n->_('project_notdeleted'));
            }
        }
        else{
            $this->view->setVar("project", $record->query);
            $this->view->setVar("file", $file->query);
            $this->tag->setDefault("id", $paramid);
            $this->tag->setDefault("fid", $paramfid);
            $this->tag->setDefault("parent", $file->query->parent_id);
        }
    }

    public function addfileAction()
    {
        $paramid = $this->dispatcher->getParam('id');
        $record = (new \Phaldoc\Projects)->id($paramid);
        $this->view->setVar("project", $record->query);
        $this->appendTitle('view/'.$record->query->id,$record->query->project);
        $this->appendTitle('addfile','projects_addfile_title');
        if ($this->request->isPost() == true) 
        {
            $rst = $this->request->getPost("rst", "striptags");
            // TODO - parent choose
            $parent_id = 1;
            $is_parent = 1;

            // Count to ordinal
            $ordinal = \Phaldoc\Models\Files::count("project_id = '$parent_id' AND parent_id = '$parent_id'");
            $ordinal++;

            $validation = new \Phaldoc\Validation();
            $validation->required('rst',$this->i18n->_('validation_rst_required'));
            $data = $validation->render($_POST);

            if($data['success'] == '1'){
                $rec = (new \Phaldoc\Files)->add($record->query->id, $parent_id, $is_parent, $ordinal, $rst);

                $this->flashSession->success($this->i18n->_('settings_fileadded'));
                return $this->response->redirect('projects/view/'.$record->query->id);
            }
            else
            {
                $this->flashSession->error($data['errors'][0]['message']);
            }
        }
    }

    public function editfileAction()
    {
        $paramid = $this->dispatcher->getParam('id');
        $paramfid = $this->dispatcher->getParam('fid');
        $record = (new \Phaldoc\Projects)->id($paramid);
        $file = \Phaldoc\Models\Files::findFirst("id = '$paramfid'");
        $this->appendTitle('view/'.$record->query->id,$record->query->project);
        $this->appendTitle('editfile','projects_editfile_title');
        $this->view->setVar("project", $record->query);
        $this->view->setVar("file", $file);
        if ($this->request->isPost() == true) 
        {
            $rst = $this->request->getPost("rst", "striptags");
            $validation = new \Phaldoc\Validation();
            $validation->required('rst',$this->i18n->_('validation_projectfile_required'));
            $data = $validation->render($_POST);

            if($data['success'] == '1'){
                $rec = (new \Phaldoc\Files)->id($paramfid)->save($file->project_id, $file->parent_id, $file->is_parent, $file->ordinal, $rst);

                $this->flashSession->success($this->i18n->_('validation_saved'));
                return $this->response->redirect('projects/view/'.$paramid);
            }
            else
            {
                $this->flashSession->error($data['errors'][0]['message']);
            }
        }
        else{
            $this->tag->setDefault("rst", $file->rst);
        }

    }

    public function viewfileAction()
    {
        $paramid = $this->dispatcher->getParam('id');
        $paramfid = $this->dispatcher->getParam('fid');
        $record = (new \Phaldoc\Projects)->id($paramid);
        $file = (new \Phaldoc\Files)->id($paramfid);
        $this->appendTitle('view/'.$record->query->id,$record->query->project);
        $this->appendTitle('deletefile','projects_viewfile_title');
        $this->view->setVar("project", $record->query);
        $this->view->setVar("file", $file->query);
        $lines = $this->modelsManager->createBuilder()->columns(array('l.*', 't.*'))
                        ->from(array('l' => '\Phaldoc\Models\Lines'))
                        ->join('\Phaldoc\Models\Translates', 'l.id = t.line_id','t','INNER')
                        ->where('l.file_id = '.$paramfid.'')
                        ->orderBy('l.ordinal ASC')
                        ->groupBy('t.line_id')
                        ->getQuery()->execute();
        $this->view->setVar("lines", $lines);
    }

    public function movefileAction()
    {
        $paramid = $this->dispatcher->getParam('id');
        $paramfid = $this->dispatcher->getParam('fid');
        $record = (new \Phaldoc\Projects)->id($paramid);
        $file = \Phaldoc\Models\Files::findFirst("id = ".$paramfid."");
        $parent = $file->parent_id;
        $newordinal = $file->ordinal;
        $newordinal--;
        if($newordinal === 0)
        {
            $newordinal = 1;
        }

        $upfile = \Phaldoc\Models\Files::findFirst(array(
                    "conditions" => "project_id = '$paramid' AND parent_id = '$parent' AND ordinal = '$newordinal'"));
        $upfile->ordinal = $file->ordinal;
        $upfile->update();
        $file->ordinal = $newordinal;
        $file->update();
        return $this->response->redirect('projects/view/'.$record->query->id);
    }

    // Managment of elements in file

    public function addlineAction()
    {
        $paramid = $this->dispatcher->getParam('id');
        $paramfid = $this->dispatcher->getParam('fid');
        $record = (new \Phaldoc\Projects)->id($paramid);
        $file = (new \Phaldoc\Files)->id($paramfid);
        $this->appendTitle('view/'.$record->query->id,$record->query->project);
        $this->breadcrumb->add('viewfile/'.$file->query->project_id.'/'.$file->id,$file->query->rst,$file->query->rst, 2);
        $this->appendTitle('','projects_addline_title');


        $this->view->setVar("project", $record->query);
        $this->view->setVar("file", $file->query);
        $this->view->setVar("elements", (array) $this->config->elements);
    }
}