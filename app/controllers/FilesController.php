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
		$typs = 1;
		$files = $this->modelsManager->createBuilder()
			->addFrom('PhaldocFiles','f')
			->join('PhaldocParts', 'f.id = p.file_id','p','INNER')
			->join('PhaldocDocs', 'p.id = d.part_id','d','INNER')
			->where('p.type = :type:', array('type' => $type))
			->andWhere('d.lang_id = :lang:', array('lang' => $langid))
			->orderBy('f.ordinal DESC')
			->getQuery()
			->execute();

		$count = $files->count();

		$this->view->setVar("files", $files);
		$this->view->setVar("count", $count);
	}

}

