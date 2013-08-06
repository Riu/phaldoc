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
		// create json's files
		$this->response->redirect("json");
	}

}

