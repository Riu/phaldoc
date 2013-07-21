<?php

class FilesController extends ControllerBase
{

	public function initialize()
	{
		parent::initialize();
	}

	public function indexAction()
	{
		$langid = $this->session->get('langid');
		$type = 1;
		$files = $this->modelsManager->createBuilder()
			->columns(array('f.rst','f.type','d.title','p.id'))
			->addFrom('PhaldocFiles','f')
			->join('PhaldocParts', 'f.id = p.file_id','p','INNER')
			->join('PhaldocDocs', 'p.id = d.part_id','d','INNER')
			->where('p.type = :type:', array('type' => $type))
			//->andwhere('f.type = :type:', array('type' => 1))
			->andWhere('d.lang_id = :lang:', array('lang' => $langid))
			->orderBy('f.type ASC')
			//->orderBy('f.parent_id ASC')
			//->orderBy('f.ordinal ASC')
			->getQuery()
			->execute();

		$count = $files->count();

		$this->view->setVar("files", $files);
		$this->view->setVar("count", $count);
	}

}

