<?php namespace Phaldoc;

class Module implements \Phalcon\Mvc\ModuleDefinitionInterface 
{

    // deklarach dla 2.0.0 public function registerAutoloaders(\Phalcon\DiInterface $di = NULL)
    public function registerAutoloaders(\Phalcon\DiInterface $di = NULL)
    {
        $config = $di->get('config');
        $loader = new \Phalcon\Loader();

        $namespace = array(
            __NAMESPACE__.'\Controllers'    => '../apps/phaldoc/'.$config->app->controllers,
            __NAMESPACE__.'\Models'         => '../apps/phaldoc/'.$config->app->models
        );
        if(!empty($config->library)) 
        {
            foreach($config->library as $name => $patch) 
            {
                $namespace[$name] = '../'.$config->app->library.$patch;
            }
        }
        $loader->registerNamespaces($namespace);
        $loader->register();
    }
    
    // deklaracja dla 2.0.0 public function registerServices(\Phalcon\DiInterface $di)    
    public function registerServices(\Phalcon\DiInterface $di)
    {
        $config = $di->get('config');

        $di->set('dispatcher', function() use ($di) {
            $eventsManager = $di->getShared('eventsManager');
            $dispatcher = new \Phalcon\Mvc\Dispatcher();
            $dispatcher->setEventsManager($eventsManager);
            $dispatcher->setDefaultNamespace(__NAMESPACE__.'\Controllers\\');
            return $dispatcher;
        });



        $di->set('view', function() use ($config){
            $view = new \Phalcon\Mvc\View();
            $view->setViewsDir('../apps/phaldoc/'.$config->app->views.'/');
            $view->registerEngines(array(
                '.volt' => function($view, $di) {
                    $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);
                    $volt->setOptions(array(
                        'compiledPath' => '../apps/phaldoc/cache/volt/',
                        'compiledExtension' => '.php',
                        'compileAlways' => true,
                        'compiledSeparator' => '_'
                    ));

                    return $volt;
                }
            ));

            return $view;
        });
        $di->set('flashSession', function(){
            return new \Phalcon\Flash\Session(array(
                'error' => 'alert alert-warning alert-small',
                'success' => 'alert alert-success',
                'notice' => 'alert alert-info',
            ));
        });

        $di->set('flash', function() {
            return new \Phalcon\Flash\Direct(array(
                'error' => 'alert alert-error',
                'success' => 'alert alert-success',
                'notice' => 'alert alert-info',
            ));
        });
     }

}
