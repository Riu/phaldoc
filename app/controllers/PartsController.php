<?php

class PartsController extends ControllerBase
{

	public function initialize()
	{
		parent::initialize();
	}

	public function indexAction()
	{
		$parent = $this->dispatcher->getParam("parent");
		$index = PhaldocFiles::findFirst("id = $parent");
		$title = 'Parent file: '.$index->rst.'.rst';
		$langid = $this->session->get('langid');
		$parts = $this->modelsManager->createBuilder()
			->columns(array('p.type', 'p.is_tree', 'p.ordinal','d.title', 'd.value', 'd.status', 'p.id','p.file_id'))
			->addFrom('PhaldocParts','p')
			->join('PhaldocDocs', 'p.id = d.part_id','d','INNER')
			->where('p.file_id = :parent:', array('parent' => $parent))
			->andWhere('d.lang_id = :lang:', array('lang' => $langid))
			->orderBy('p.ordinal ASC')
			->getQuery()->execute();

		$count = $parts->count();
		$this->view->setVar("title", $title);
		$this->view->setVar("lang", $langid);
		$this->view->setVar("id", $index->id);
		$this->view->setVar("parent", $index->parent_id);
		$this->view->setVar("parts", $parts);
		$this->view->setVar("count", $count);
		
	}

	public function moveAction()
	{
		$id = $this->dispatcher->getParam("id");
		$part = PhaldocParts::findFirst("id = '$id'");
		$file = $part->file_id;
		$ordinal = $part->ordinal;
		$type = $part->type;

		if($ordinal !== '1')
		{
			$newordinal = $ordinal-1;

			$part->ordinal = $newordinal;

			$prev = PhaldocParts::findFirst("file_id = '$file' AND ordinal = '$newordinal'");
			$prev->ordinal = $ordinal;

			if($newordinal==='1')
			{
				$part->type = '1';
				$prev->type = $type;
			}

			if($part->update() AND $prev->update())
			{
				$this->response->redirect('parts/'.$file);
			}

		}
		else
		{
			$this->response->redirect('parts/'.$file);
		}
	}

	public function deleteAction()
	{
		$id = $this->dispatcher->getParam("id");
		$part = PhaldocParts::findFirst("id = '$id'");
		$doc = PhaldocDocs::findFirst("part_id = '$id' AND lang_id = '1'");
		$file = $part->file_id;
		if($this->request->isPost())
		{
			if($part->delete())
			{
				$i = 1;
				$parts = PhaldocParts::find("file_id = '$file'");
				foreach($parts as $p)
				{
					$p->ordinal = $i;
					$p->update();
					$i++;
				}
				$this->response->redirect('parts/'.$part->file_id);
			}
		}

		$this->view->setVar("part", $part);
		$this->view->setVar("doc", $doc);
	}

	public function addAction()
	{
		$id = $this->dispatcher->getParam("id");
		$file = PhaldocFiles::findFirst("id = '$id'");
		$this->view->setVar("file", $file);

		$count = PhaldocParts::find("file_id = '$id'");

		$count = $count->count();
		$count++;
		$this->view->setVar("ordinal", $count);
	}

	public function createAction()
	{
		$id = $this->dispatcher->getParam("id");
		if ($this->request->isPost()) 
		{
			$title = $this->request->getPost("title", "striptags");
			$ordinal = $this->request->getPost("ordinal");
			$type = $this->request->getPost("type");
			$file = PhaldocFiles::findFirst("id = '$id'");

			$newpart = new PhaldocParts();
			$newpart->file_id = $file->id;
			$newpart->ordinal = $ordinal;
			$newpart->type = $type;
			$newpart->is_tree = 0;
			$newpart->updated = time();
			$newpart->create();
			$part_id = $newpart->id;

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
			}

			$this->flashSession->success("Part has been successfully added");
			$this->response->redirect('parts/'.$id);
			
		}
		else
		{
			return $this->dispatcher->forward(array("controller" => "parts", "action" => "add","id" => $id));
		}
	}

	public function editAction()
	{

		$id = $this->dispatcher->getParam("id");
		$part = PhaldocParts::findFirst("id = '$id'");
		$langid = $this->session->get('langid');
		$doc = PhaldocDocs::findFirst("part_id = '$id' AND lang_id = '$langid'");
		$this->view->setVar("part", $part);
		$this->view->setVar("doc", $doc);

		\Phalcon\Tag::displayTo("title", $doc->title);
		\Phalcon\Tag::displayTo("value", $doc->value);
		\Phalcon\Tag::setDefault("type", $part->type);
		\Phalcon\Tag::setDefault("status", $doc->status);
	}

	public function saveAction()
	{
		$id = $this->dispatcher->getParam("id");
		if ($this->request->isPost()) 
		{
			$title = $this->request->getPost("title", "striptags");
			$value = $this->request->getPost("value");
			$type = $this->request->getPost("type");
			$status = $this->request->getPost("status");
			$part = PhaldocParts::findFirst("id = '$id'");
			$ordinal = $part->ordinal;
			$fileid = $part->file_id;
			$part->type = $type;

			$langid = $this->session->get('langid');
			if($langid==='1')
			{
				$part->updated = time();
			}
			$doc = PhaldocDocs::findFirst("part_id = '$id' AND lang_id = '$langid'");
			$doc->title = $title;
			$doc->value = $value;
			$doc->status = $status;
			$doc->updated = time();
			if($part->update() AND $doc->update())
			{
				$this->saveparts($fileid,$langid);
				if($langid==='1')
				{
					if($ordinal!=='1')
					{
						$firstpart = PhaldocParts::findFirst("file_id = '$fileid' AND ordinal = '1'");
						$firstpartid = $firstpart->id;
						$subf = PhaldocDocs::find("part_id = '$firstpartid' AND lang_id != '$langid'");
						foreach($subf as $sf)
						{
							$sf->status = '4';
							$sf->update();
						}
					}

					$subp = PhaldocDocs::find("part_id = '$id' AND lang_id != '$langid'");
					foreach($subp as $sp)
					{
						$sp->status = '2';
						$sp->update();
					}
				}
				$this->response->redirect('parts/edit/'.$id);
				$this->flashSession->success("Saved");
			}
			else
			{
				$this->flashSession->error("Changes not saved");
				$this->response->redirect('parts/edit/'.$id);
			}
			
		}
		else
		{
			return $this->dispatcher->forward(array("controller" => "parts", "action" => "edit","id" => $id));
		}
	}


	public function saveparts($fileid,$langid)
	{
		$lang = $this->session->get('lang');
		$file = PhaldocFiles::findFirst("id = $fileid");
		$this->filesave($file->id, $file->rst, $lang, $langid);
	}
}

