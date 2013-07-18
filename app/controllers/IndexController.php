<?php

class IndexController extends ControllerBase
{

	public function initialize()
	{
		parent::initialize();
	}

	public function indexAction()
	{
		$lang = $this->session->get('lang');

		$files = PhaldocFiles::findFirst("rst = 'index'");
		$this->view->setVar("index", $index);

		$langs = PhaldocFiles::find("rst != 'index'");
		$this->view->setVar("langs", $langs);
			
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

