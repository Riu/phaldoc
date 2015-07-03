<?php namespace Phaldoc;

use Phalcon\Tag as Tag;
use Phalcon\Mvc\Model\Criteria;

class BaseController extends \Phalcon\Mvc\Controller
{

    public $limit; // Liczba rekordów wyświetalnych na stronę
    public $total; // Liczba rekordów na stronę
    public $firstlink; // Numer pierwszej strony
    public $lastlink; // Numer ostatniej strony 
    public $page; // Aktualna strona
    public $pageurl; // Aktualna strona
    public $pages; // Aktualna strona
    public $nextpage; // Numer następnej strony
    public $prevpage; // Numer poprzedniej strony
    public $numlinks; // Liczba linków wyświetlanych przed i za aktualnym linkiem
    public $offset; // Offset potrzebny dla 
    public $results; // Rezultat (rekordy) przekazywany do widoku
    public $i18n; // Tłumaczenie

    public $uid;
    public $me;
    public $have;

    protected function initialize()
    {
        
        Tag::setDoctype(Tag::HTML5); 
        $module = $this->dispatcher->getModuleName();
        $controller = $this->dispatcher->getControllerName();
        $this->view->setVar("module", $module);
        $this->i18n = $this->_getTranslation();
        $this->view->setVar("i18n", $this->i18n);
        Tag::setTitle($this->i18n->_('phaldoc_title'));
    }

    protected function appendTitle($slug,$key)
    {
        $title = $this->i18n->_($key);
        \Phalcon\Tag::appendTitle(" - ".$title);
        $this->breadcrumb->add($slug,$title);        
    }

    protected function _getTranslation()
    {
        $language = $this->session->get('lg');
        if(empty($language))
        {
            //Ask browser what is the best language
            $language = $this->request->getBestLanguage();
        }

        //Check if we have a translation file for that lang
        if (file_exists("../i18n/".$language.".php")) {
           require "../i18n/".$language.".php";
        } else {
           // fallback to some default
           require "../i18n/en.php";
        }

        //Return a translation object
        return new \Phalcon\Translate\Adapter\NativeArray(array(
           "content" => $messages
        ));

    }

    public function offset($total = 0)
    {

        $this->total = $total;
        $this->firstlink = 1;

        if(empty($this->limit))
        {
            $this->limit = 10;
        }

        $this->pages = (int) ceil($this->total / $this->limit);

        $this->lastlink = $this->pages;

        $this->page = $this->dispatcher->getParam('page');

        if(empty($this->page))
        {
             $this->page = 1;
        }

        $this->offset = ($this->page*$this->limit)-$this->limit;

        $this->prevpage = 1;

        if($this->page > 1 AND $this->pages > 1)
        {
            $this->prevpage = $this->page-1;
        }

        $this->nextpage = $this->page+1;

        if($this->pages == $this->page OR $this->page > $this->pages)
        {
            $this->nextpage = $this->pages;
        }

        if($this->page AND $this->pages > $this->page)
        {
            $this->breadcrumb->add($this->page,'Strona '.$this->page);
            \Phalcon\Tag::appendTitle(" - Strona ".$this->page);
        }

    }

    public function pagination($pageurl)
    {
        $this->pageurl = $pageurl;

        $this->view->setVar("total", $this->total);
        $this->view->setVar("firstlink", $this->firstlink);
        $this->view->setVar("lastlink", $this->lastlink);
        $this->view->setVar("page", $this->page);
        $this->view->setVar("pages", $this->pages);
        $this->view->setVar("pageurl", $this->pageurl);
        $this->view->setVar("nextpage", $this->nextpage);
        $this->view->setVar("prevpage", $this->prevpage);
        $this->view->setVar("numlinks", $this->numlinks);
    }
}
