<?php

class IndexController extends ControllerBase
{

	public function initialize()
	{
		parent::initialize();
	}

	public function indexAction()
	{
			
	}

	public function aboutAction()
	{

	}

	public function settingsAction()
	{

		$lang = $this->session->get('lang');

		$langs = PhaldocLangs::find();
		$this->view->setVar("langs", $langs);

		$lang = PhaldocLangs::findFirst("lang = '$lang'");
		$this->view->setVar("lang", $lang);
	}

	public function langAction()
	{
		$lang = $this->dispatcher->getParam("lang");
		if(!empty($lang))
		{
			$this->session->set('lang', $lang);
			$this->cookies->set('lang', $lang, 31536000);
		}
		$where = $this->request->getHeader('REQUEST_URI');
		$this->response->redirect("");
	}

}

