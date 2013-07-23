<?php

class SetupController extends ControllerBase
{
	public $addfiles = array();
	public $addparts = array();

	public function initialize()
	{
		parent::initialize();
	}

	public function indexAction()
	{
		$part = $this->dispatcher->getParam("part");
		$this->view->setVar("part", $part);

		$lang = $this->session->get('lang');
		$dir = $this->config->application->docsDir.$lang.'/';
		if($part === '1')
		{
			$this->addFiles($dir,'index');
			$this->addFilesToSql();
		}
		elseif($part === '2')
		{
			$this->addPartsToSql($dir);
		}
	}


	public function addFiles($dir,$file,$folder = '',$key = 'start') 
	{
		$new = $dir.$folder.$file.'.rst';
		$lines = file($new);
		$this->addfiles[$key][] = $folder.$file;
		$count = count($lines);
		$ds = $count;
		$de = $count;

		foreach ($lines as $line_num => $line)
		{
			$line = ltrim($line);

			if (preg_match("/toctree::\n/i", $line))
			{
				$ds = $line_num+2;
			}

			if($line_num > $ds AND $line_num < $de)
			{
				$line = str_replace("\n", '', $line);
				if(!empty($line))
				{
					$dirs = explode("/", $line);
					if($dirs[0]==='reference' OR $dirs[0]==='api')
					{
						$this->addFiles($dir,$dirs[1],$dirs[0].'/',$folder.$file);
					}
					else
					{
						$this->addFiles($dir,$line,$folder,$folder.$file);
					}
				}
				else
				{
					$de = $line_num;
				}
			}
		}
	}

	public function addFilesToSql() 
	{
		foreach($this->addfiles as $key=>$array)
		{
			if($key==='start')
			{
				$parent = 1;
				$type = 1;
			}
			else
			{
				$file = PhaldocFiles::findFirst("rst = '$key'");
				$parent = $file->id;

				if($key==='api/index')
				{
					$type = 3;
				}
				else
				{
					$type = 2;
				}
			}

			$i = 1;

			foreach($array as $a)
			{
				if($a==='api/index')
				{
					$type = 3;
				}
				$new = new PhaldocFiles();
				$new->parent_id = $parent;
				$new->ordinal = $i;
				$new->type = $type;
				$new->is_parent = '0';
				$new->rst = $a;
				$new->create();
				$i++;
			}
		}
	} 

	public function addPartsToSql($dir) 
	{
		$langid = $this->session->get('langid');
		$files = PhaldocFiles::find();
		foreach($files as $file)
		{

			$new = $dir.$file->rst.'.rst';
			$fileid = $file->id;
			$lines = file($new);

			$result = array();

			$c = 0;
			$i = 0;

			foreach ($lines as $line_num => $line) {

				$line = ltrim($line);
				$line = str_replace('^', ":", $line);

				if (preg_match("/====\n/i", $line) OR preg_match("/----\n/i", $line) OR preg_match("/::::\n/i", $line)) {

					if(!empty($c))
					{
						$i++;
					}
					else
					{
						$c++;
					}

					if (preg_match("/====\n/i", $line))
					{
						$result[$i]['type'] = 1;
					}
					elseif(preg_match("/----\n/i", $line))
					{
						$result[$i]['type'] = 2;
					}
					else
					{
						$result[$i]['type'] = 3;
					}

					$result[$i]['title'] = $lines[$line_num-1];
					$result[$i]['is_tree'] = 0;

				}


				if(!empty($result[$i]))
				{
					$result[$i]['lines'][] = $lines[$line_num-1];
					if (preg_match("/toctree::\n/i", $lines[$line_num-1]) AND $result[$i]['is_tree'] == 0)
					{
						$result[$i]['is_tree'] = 1;
					}
				}

			}
			
			$i = 1;
			$tree = 0;
			foreach($result as $part)
			{
				if(!empty($part['is_tree']))
				{
					$tree = 1;
				}
				$newpart = new PhaldocParts();
				$newpart->file_id = $fileid;
				$newpart->ordinal = $i;
				$newpart->type = $part['type'];
				$newpart->is_tree = $part['is_tree'];
				$newpart->updated = time();
				$newpart->create();
				$part_id = $newpart->id;

				$doc = new PhaldocDocs();
				$doc->lang_id = $langid;
				$doc->part_id = $part_id;
				$doc->title = $part['title'];
				$lines = $part['lines'];
				$lines = array_slice($lines, 2); 

				$value = '';
				foreach($lines as $l)
				{
					$value .= $l;
				}

				$doc->value = $value;
				$doc->updated = time();
				$doc->status = 1;
				$doc->create();

				$i++;
			}

			if(!empty($tree))
			{
				$fileup = PhaldocFiles::findFirst("id = '$fileid'");
				$fileup->is_parent = '1';
				$fileup->update();
			}

		}
	}

}

