<?php namespace Phaldoc;

class Api extends \Phalcon\DI\Injectable {

    public $table;
    public $model;
    public $class;    
    public $connection;
    public $params;
    public $query;
    public $id = 0;
    public $json = array();

    public function __construct()
    {
        $this->class = '\\Phaldoc\\Models\\'.$this->model;
        return $this;
    }

    public function id($id)
    {
        $this->id = $id;
        $class = $this->class;
        if(!empty($this->id))
        {
            $this->query = $class::findFirst($this->id);
        }
        return $this;
    }

    public function params(array $keys,array $values)
    {
        for($i = 0; $i < count($keys); ++$i) {
            $this->params[$keys[$i]] = $values[$i];
        }
        return $this;
    }

    public function param($key, $value)
    {
        $this->params[$key] = $value;
        return $this;
    }

    public function create()
    {
        $query = new $this->class();

        foreach ($this->params as $key => $value) {
            $query->{$key} = $value;
        }

        if( $query->create() !== FALSE)
        {
            return $query->id;
        }
    }

    public function read()
    {
        if(!empty($this->query->id))
        {
            return $this->query;
        }
    }

    public function update()
    {
        foreach ($this->params as $key => $value) {
            $this->query->{$key} = $value;
        }
        if( $this->query->update() !== FALSE)
        {
            return TRUE;
        }
    }

    public function delete()
    {
        if(!empty($this->query->id))
        {
            $this->query->delete();
            return TRUE;
        }
    }                
}