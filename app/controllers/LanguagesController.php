<?php

class LanguagesController extends ControllerBase
{

	public function initialize()
	{
		parent::initialize();
	}

	public function indexAction()
	{
		$langs = PhaldocLangs::find();
		$count = $langs->count();
		$this->view->setVar("langs", $langs);
		$this->view->setVar("count", $count);
		
	}

	public function deleteAction()
	{
		$id = $this->dispatcher->getParam("id");
		$lang = PhaldocLangs::findFirst("id = '$id'");
		if($_POST)
		{
			$dir = $lang->lang;

			if($lang->delete())
			{
				$this->filedelete($dir);
				$this->response->redirect('languages');
			}
		}
		$this->view->setVar("lang", $lang);
	}

	public function addAction()
	{

	}

	public function createAction()
	{
		if ($this->request->isPost()) 
		{
			$lang = $this->request->getPost("lang", "striptags");
			$lang = \Phalcon\Tag::friendlyTitle($lang);
			$langname = $this->request->getPost("langname", "striptags");


			$count = PhaldocLangs::findFirst("lang = '$lang'");

			if(!empty($count))
			{
				$this->flashSession->error('Lang exist');
				$this->response->redirect('languages/add');
			}
			else
			{
				$new = new PhaldocLangs();
				$new->lang = $lang;
				$new->langname = $langname;

				if (!$new->create()) 
				{
						$this->flashSession->error('All inputs are required');
						$this->response->redirect('languages/add');
				} 
				else 
				{
					$lang_id = $new->id;
					$docs = PhaldocDocs::find("lang_id = '1'");
					foreach($docs as $d)
					{
						$doc = new PhaldocDocs();
						$doc->lang_id = $lang_id;
						$doc->part_id = $d->part_id;
						$doc->title = $d->title;
						$doc->value = $d->value;
						$doc->updated = $d->updated;
						$doc->status = $d->status;
						$doc->create();
					}

					$this->copylangfolder('en', $lang);
					$this->flashSession->success("Lang has been successfully added");
					$this->response->redirect('languages');
				}
			}
		}
		else
		{
			return $this->dispatcher->forward(array("controller" => "languagess", "action" => "add"));
		}
	}

	public function copylangfolder($src, $dst) 
	{
		$appdir = $this->config->application->docsDir;
		$src = $appdir.$src;
		$dst = $appdir.$dst;

		$dir = opendir($src);
		$result = ($dir === false ? false : true);

		if ($result !== false){
			$result = @mkdir($dst);

			if ($result === true)
			{
				while(false !== ( $file = readdir($dir)) )
				{
					if (( $file != '.' ) && ( $file != '..' ) && $result)
					{
						if ( is_dir($src . '/' . $file) )
						{
							$result = $this->copylangfolder($src . '/' . $file,$dst . '/' . $file); 
						}
						else 
						{
							$result = copy($src . '/' . $file,$dst . '/' . $file); 
						}
					}
				}
				closedir($dir);
			}
		}

		return $result;
	}
}

