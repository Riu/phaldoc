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
			->andWhere('f.id = :fid:', array('fid' => '2'))
			->orderBy('p.ordinal ASC')
			->getQuery()->execute();
		
		$arr = array();
		
		foreach($docs as $d)
		{
			$rst = \Phalcon\Tag::friendlyTitle($d['rst'], '-');
			$key = $rst.'_'.$d['ordinal'];
			$keyheader = $key.'_header';
			$arr[$keyheader] = $d['title'];
			$parttext = explode("\r\n\r\n", $d['value']);
			array_pop($parttext);
			$i = 1;
			foreach($parttext as $p)
			{
				$pk = $key.'_text_'.$i;
				$arr[$pk] = $p;
				$i++;
			}
		}
		
		$value = json_encode($arr);
		$jsondir = $this->config->application->jsonDir;
		$lang = $this->session->get('lang');
		$fp = fopen($jsondir.DIRECTORY_SEPARATOR.$lang.'.json' , 'w+');
		fwrite($fp,$value);
		fclose($fp);
		$this->response->redirect("json");
	}

}

