<?php namespace Phaldoc;

class Breadcrumb {

    public $crumbs = array();
    public $countcrumbs;

    public function __construct() 
    {

        $this->countcrumbs = 1;
        $this->crumbs = array( 0 => array('url'=>'','crumb'=>'','title'=>'','i'=>$this->countcrumbs));
    }

    public function add($url, $crumb, $title = FALSE, $param = 1)
    {

        if($title === FALSE)
        {
            $title = $crumb;
        }

        if($param === 1)
        {
            $key = $this->countcrumbs-1;
            if($key === 0)
            {
                $url = $this->crumbs[$key]['url'].$url;
            }
            else
            {
                $url = $this->crumbs[$key]['url'].DIRECTORY_SEPARATOR.$url;
            }
        }
        else
        {
            if($param > 0)
            {
                $key = $param-1;
                $url = $this->crumbs[$key]['url'].DIRECTORY_SEPARATOR.$url;
            }
            else
            {
                $url = $this->crumbs[0]['url'].$url;
            }
        }
        $this->countcrumbs++;
        $array = array('url'=>$url,'crumb'=>$crumb,'title'=>$title,'i'=>$this->countcrumbs);
        array_push($this->crumbs, $array);

        return $this;
    }

    public function render()
    {
        return $this;
    }
}
