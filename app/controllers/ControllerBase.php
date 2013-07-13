<?php

use Phalcon\Tag as Tag;

class ControllerBase extends \Phalcon\Mvc\Controller
{

	protected function initialize()
	{
		Tag::setDoctype(Tag::HTML5); 
		Tag::setTitle('Phaldoc');
	}
}
