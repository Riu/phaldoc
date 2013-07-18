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

		$files = $this->modelsManager->createBuilder()
    			->from('PhaldocDocs')
    			->getQuery()
    			->execute();
	}

}

