<?php

class LanguagesController extends ControllerBase
{

	public function initialize()
	{
		parent::initialize();
	}

	public function indexAction()
	{

		
	}

	public function deleteAction()
	{

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
				$file = new PhaldocLangs();
				$file->lang = $lang;
				$file->langname = $langname;

				if (!$file->create()) 
				{
						$this->flashSession->error('All inputs are required');
						$this->response->redirect('languages/add');
				} 
				else 
				{
					$this->copylangfolder('en', $lang) 
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
							$result = recurseCopy($src . '/' . $file,$dst . '/' . $file); 
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

