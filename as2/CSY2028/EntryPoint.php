<?php
namespace CSY2028;
class EntryPoint {
    private $routes;
    public function __construct(\Job\Routes $routes) {
    $this->routes = $routes;
    }
    public function run() {

    $route = ltrim(explode('?', $_SERVER['REQUEST_URI'])[0], '/');
 
    if ($route == '') {
        $route = $this->routes->getDefaultRoute();
       }
     

    $uri=explode('/', $route);
    $controllerName = array_shift($uri);
    $functionName = array_shift($uri);
    $this->routes->checkLogin($controllerName . '/' . $functionName);
    $controller = $this->routes->getController($controllerName);
        
       if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $functionName = $functionName . 'Submit';
       }
       
   
       $page = $controller->$functionName();
    
    
    $output = $this->loadTemplate('../templates/' . $page['template'], 
   $page['variables']);

    $title = $page['title'];

    $layoutVariables = $this->routes->getLayoutVariables();
    $layoutVariables['title'] = $title;
    $layoutVariables['output'] = $output;
    echo $this->loadTemplate('../templates/layout.html.php', $layoutVariables);
    }


    function loadTemplate($fileName,$templateVars){
        extract($templateVars);
        ob_start();
        require $fileName;
        $contents=ob_get_clean();
        return $contents;
    
    }
}

?>