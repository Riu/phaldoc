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
		$this->view->setVar("files", $files);
		$this->view->setVar("count", $count);
	}

}

