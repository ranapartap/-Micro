<?php

namespace Micro\Core;

use Micro\Controller\RouteController;

class Application
{
    /** Klein Variables **/
    static $request;    //Klein $request variable
    static $response;   //Klein $respond variable
    static $service;    //Klein $service variable
    static $app;        //Klein $app variable

    static $router;     //Klein Router Object

    static $pages;      //Holds Dynamic Pages List

    static $enqueue_scripts;        //Holds enequed scripts List
    static $enqueue_styles;         //Holds enequed styles List


    /**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method or the fallback
     */
    public function __construct()
    {
//        $this->Router = new RouteController();
        self::$router = new RouteController();
    }

    public static function render($path, $vars) {

        ob_start();
        Application::$service->render($path, $vars);
        $html = ob_get_clean();

        $scripts_head = "<!--Head Scripts -->".PHP_EOL. JSLoad(false);
        $scripts_foot = "<!--Footer Scripts -->".PHP_EOL. JSLoad(true);

//        var_dump($scripts_head);
        $html = str_replace('</head>',$scripts_head . PHP_EOL . '</head>' , $html );
//        var_dump($scripts_foot);
        $html = str_replace('</body>',$scripts_foot . PHP_EOL . '</body>' , $html );

        echo $html;
    }

}
