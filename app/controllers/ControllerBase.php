<?php

use Phalcon\Tag as Tag;

class ControllerBase extends \Phalcon\Mvc\Controller
{

	protected function initialize()
	{
		Tag::setDoctype(Tag::HTML5); 
		Tag::setTitle('Phaldoc');

		$lang = $this->session->get('lansg');

		if(empty($lang))
		{
			$cl = $this->cookies->get('lang')->getValue();

			if(!empty($cl))
			{
				$this->session->set('lang', $cl);
				$this->cookies->set('lang', $cl, 31536000);
			}
			else
			{
				$this->session->set('lang', 'en');
				$this->cookies->set('lang', 'en', 31536000);
			}
		}
		else
		{
			$this->session->set('lang', $lang);
		}
	}
}
