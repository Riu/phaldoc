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
		
	}

	public function deleteAction()
	{

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

	}

	public function editAction()
	{

	}

	public function saveAction()
	{

	}

}

