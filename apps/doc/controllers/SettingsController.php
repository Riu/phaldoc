<?php namespace Doc\Controllers;

class SettingsController extends \Phaldoc\BaseController
{
    protected function initialize()
    {
        parent::initialize();
        $this->appendTitle('settings','settings_title');
    }    

    public function indexAction()
    {
        $langs = \Phaldoc\Models\Langs::find();
        $this->view->setVar("langs", $langs);
    }

    public function addAction()
    {
        $this->appendTitle('add','settings_add_title');
        if ($this->request->isPost() == true) 
        {
            $lang = $this->request->getPost("lang", "striptags");
            $langname = $this->request->getPost("langname", "striptags");

            
            $validation = new \Phaldoc\Validation();
            $validation->required('lang',$this->i18n->_('validation_lang_required'));
            $validation->required('langname',$this->i18n->_('validation_langname_required'));
            $data = $validation->render($_POST);

            if($data['success'] == '1'){
                $rec = (new \Phaldoc\Langs)->add($lang, $langname);

                $this->flashSession->success($this->i18n->_('settings_added'));
                return $this->response->redirect('langs');
            }
            else
            {
                $this->flashSession->error($data['errors'][0]['message']);
            }
        }
    }

    public function editAction()
    {
        $this->appendTitle('edit','settings_edit_title');
        $paramid = $this->dispatcher->getParam('id');
        $record = (new \Phaldoc\Langs)->id($paramid);
        if ($this->request->isPost() == true) 
        {
            $lang = $this->request->getPost("lang", "striptags");
            $langname = $this->request->getPost("langname", "striptags");

            
            $validation = new \Phaldoc\Validation();
            $validation->required('lang',$this->i18n->_('validation_lang_required'));
            $validation->required('langname',$this->i18n->_('validation_langname_required'));
            $data = $validation->render($_POST);

            if($data['success'] == '1'){
                $rec = (new \Phaldoc\Langs)->id($paramid)->save($lang, $langname);

                $this->flashSession->success($this->i18n->_('validation_saved'));
                return $this->response->redirect('settings');
            }
            else
            {
                $this->flashSession->error($data['errors'][0]['message']);
            }
        }
        else{
            $this->view->setVar("langs", $record->query);
            $this->tag->setDefault("id", $paramid);
            $this->tag->setDefault("lang", $record->query->lang);
            $this->tag->setDefault("langname", $record->query->langname);
        }
    }

    public function deleteAction()
    {
        $this->appendTitle('delete','settings_delete_title');
        $paramid = $this->dispatcher->getParam('id');
        $record = (new \Phaldoc\Langs)->id($paramid);
        if ($this->request->isPost() == true) 
        {
            $id = $this->request->getPost("id", "striptags");
            if($id === $paramid){
                $rec = (new \Phaldoc\Langs)->id($id)->delete();
                $this->flashSession->success($this->i18n->_('settings_deleted'));
                return $this->response->redirect('projects');
            }
            else
            {
                $this->flashSession->error($this->i18n->_('settings_notdeleted'));
            }
        }
        else{
            $this->view->setVar("langs", $record->query);
            $this->tag->setDefault("id", $paramid);
        }
    }

    public function settingsAction()
    {

        $this->appendTitle('delete','settings_settings_title');
        $file = '../config/config.ini';
        
        if ($this->request->isPost() == true) 
        {
            $data = $this->request->getPost("data");

            $fp = fopen($file, 'w+');
            fwrite($fp,$data);
            fclose($fp);

            $this->flashSession->success($this->i18n->_('validation_saved'));
            return $this->response->redirect('settings');
        }
        else
        {

            if(is_file($file)){
                $data  = file_get_contents($file);
            }
            $this->tag->setDefault("data", $data);
        }

    }
}