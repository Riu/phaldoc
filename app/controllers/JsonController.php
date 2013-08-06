<?php

class JsonController extends ControllerBase
{

	public function initialize()
	{
		parent::initialize();
	}


	public function indexAction()
	{

	}

	public function createAction()
	{
		$langid = $this->session->get('langid');
		$docs = $this->modelsManager->createBuilder()
			->columns(array('p.ordinal','d.title', 'd.value', 'f.rst'))
			->addFrom('PhaldocParts','p')
			->join('PhaldocDocs', 'p.id = d.part_id','d','INNER')
			->join('PhaldocFiles', 'p.file_id = f.id','f','INNER')
			->where('d.lang_id = :lang:', array('lang' => $langid))
			->andWhere('f.type != :type:', array('type' => '3'))
			->orderBy('p.ordinal ASC')
			->getQuery()->execute();
			
			
		$this->response->redirect("json");
	}

}

