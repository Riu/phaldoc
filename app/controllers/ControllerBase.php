<?php

use Phalcon\Tag as Tag;

class ControllerBase extends \Phalcon\Mvc\Controller
{

	protected function initialize()
	{
		Tag::setDoctype(Tag::HTML5); 
		Tag::setTitle('Phaldoc');

		$lang = $this->session->get('lang');

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
		$this->langid();
	}

	protected function langid()
	{
		$lang = $this->session->get('lang');
		$langid = $this->session->get('langid');
		if(empty($langid))
		{
			$lang = PhaldocLangs::findFirst("lang = '$lang'");
			if(!empty($lang->id))
			{
				$this->session->set('langid', $lang->id);
			}
		}
	}


	protected function filesave($file_id, $rst, $lang, $lang_id)
	{
		$dir = $this->config->application->docsDir;
		$filedir = $dir.$lang.'/'.$rst.'.rst'; 

		$parts = $this->modelsManager->createBuilder()
			->columns(array('p.type','d.title', 'd.value'))
			->addFrom('PhaldocDocs','d')
			->join('PhaldocParts', 'd.part_id = p.id','p','INNER')
			->where('p.file_id = :file:', array('file' => $file_id))
			->andWhere('d.lang_id = :lang:', array('lang' => $lang_id))
			->orderBy('p.ordinal ASC')
			->getQuery()->execute();

			$content = '';
			foreach($parts as $p)
			{
				$content .= $p->title."\n";
			
				switch ($p->type)
				{
					case '1':
						$char = '=';
					break;

					case '2':
						$char = '-';
					break;

					case '3':
						$char = '^';
					break;
				}

				$undertitle = preg_replace('/./', $char, $p->title);
				$content .= $undertitle."\n";
				$content .= "\n";
				$content .= $p->value."\n";
			}

		$fp = fopen($filedir , 'w+');
		fwrite($fp,$content);
		fclose($fp);

	}

}
