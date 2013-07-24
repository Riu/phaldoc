<?php

class FilesController extends ControllerBase
{

	public function initialize()
	{
		parent::initialize();
	}

	public function indexAction()
	{

		$parent = $this->dispatcher->getParam("parent");
		$langid = $this->session->get('langid');
		$files = $this->modelsManager->createBuilder();
		$files->columns(array('f.rst','f.type', 'f.is_parent', 'f.ordinal','d.title', 'd.status', 'p.id','p.file_id'))
			->addFrom('PhaldocFiles','f')
			->join('PhaldocParts', 'f.id = p.file_id','p','INNER')
			->join('PhaldocDocs', 'p.id = d.part_id','d','INNER');;
		if(!empty($parent))
		{
			$index = PhaldocFiles::findFirst("id = $parent");
			$title = 'Parent file: '.$index->rst.'.rst';
			$files->where('f.id != :parent:', array('parent' => $parent));
			$files->andWhere('f.parent_id = :parent:', array('parent' => $parent));
		}
		else
		{	$index = PhaldocFiles::findFirst("rst = 'index'");
			$title = 'Main file: '.$index->rst.'.rst';
			$files->where('f.id = :parent:', array('parent' => $index->id));
		}

		$files->andWhere('d.lang_id = :lang:', array('lang' => $langid))
			->orderBy('f.ordinal ASC')
			->groupBy('p.file_id');
		$files = $files->getQuery()->execute();

		$count = $files->count();
		$this->view->setVar("title", $title);
		$this->view->setVar("lang", $langid);
		$this->view->setVar("id", $index->id);
		$this->view->setVar("parent", $index->parent_id);
		$this->view->setVar("files", $files);
		$this->view->setVar("count", $count);
	}

	public function moveAction()
	{
		
		$id = $this->dispatcher->getParam("id");
		$file = PhaldocFiles::findFirst("id = '$id'");
		$parent = $file->parent_id;
		$ordinal = $file->ordinal;

		if($ordinal !== '1')
		{
			$newordinal = $ordinal-1;

			$file->ordinal = $newordinal;

			$prev = PhaldocFiles::findFirst("id != '1' AND parent_id = '$parent' AND ordinal = '$newordinal'");
			$prev->ordinal = $ordinal;

			if($file->update() AND $prev->update())
			{
				$this->response->redirect('files/'.$parent);
			}

		}

		else
		{
			$this->response->redirect('files/'.$parent);
		}
	}

	public function deleteAction()
	{
		$id = $this->dispatcher->getParam("id");
		$file = PhaldocFiles::findFirst("id = '$id'");
		if($this->request->isPost() AND $file->is_parent !== '1')
		{
			$name = $file->rst.'.rst';
			$parent_id = $file->parent_id;
			$parent = PhaldocFiles::find("parent_id = '$parent_id'");
			$count = $parent->count();
			$np = PhaldocFiles::findFirst("id = '$parent_id'");

			if(empty($count))
			{
				$np->is_parent = '0';
				$np->update();
			}
			if($file->delete())
			{


				$dir = $this->config->application->docsDir;
				$langs = PhaldocLangs::find();
				foreach($langs as $l)
				{
					$this->filedelete($l->lang, $file->rst);
				}
				$this->response->redirect('files/'.$np->id);
			}
		}
		$this->view->setVar("file", $file);

	}

	public function addAction()
	{
		$id = $this->dispatcher->getParam("id");
		$file = PhaldocFiles::findFirst("id = '$id'");
		$this->view->setVar("file", $file);

		$count = PhaldocFiles::find("parent_id = '$id' AND id != '$id'");

		$count = $count->count();
		$count++;
		$this->view->setVar("ordinal", $count);
	}

	public function createAction()
	{
		$id = $this->dispatcher->getParam("id");
		if ($this->request->isPost()) 
		{
			$rst = $this->request->getPost("rst", "striptags");
			$rst = \Phalcon\Tag::friendlyTitle($rst,'_',TRUE);
			$title = $this->request->getPost("title", "striptags");
			$ordinal = $this->request->getPost("ordinal");
			$type = $this->request->getPost("type");

			if($type === '2')
			{
				$rst = 'reference/'.$rst;
			}
			else
			{
				$rst = 'api/'.$rst;
			}

			$count = PhaldocFiles::findFirst("rst = '$rst' AND type = '$type'");

			if(!empty($count))
			{
				$this->flashSession->error('File exist');
				$this->response->redirect('files/add/'.$id);
			}
			else
			{
				$file = new PhaldocFiles();
				$file->parent_id = $id;
				$file->ordinal = $ordinal;
				$file->type = $type;
				$file->is_parent = '0';
				$file->rst = $rst;

				if (!$file->create()) 
				{
						$this->flashSession->error('All inputs are required');
						$this->response->redirect('files/add/'.$id);
				} 
				else 
				{

					$newpart = new PhaldocParts();
					$newpart->file_id = $file->id;
					$newpart->ordinal = 1;
					$newpart->type = 1;
					$newpart->is_tree = 0;
					$newpart->updated = time();
					$newpart->create();
					$part_id = $newpart->id;

					$dir = $this->config->application->docsDir;
					$langs = PhaldocLangs::find();

					foreach($langs as $l)
					{
						$doc = new PhaldocDocs();
						$doc->lang_id = $l->id;
						$doc->part_id = $part_id;
						$doc->title = $title;
						$doc->value = '';
						$doc->updated = time();
						$doc->status = 3;
						$doc->create();

						$this->filesave($file->id, $rst, $l->lang, $l->id);
					}

					$this->flashSession->success("File has been successfully added");
					$this->response->redirect('files/'.$id);
				}
			}
		}
		else
		{
			return $this->dispatcher->forward(array("controller" => "files", "action" => "add","id" => $id));
		}
	}

}

