<?php

/**
 * doc.php
 *
 * Documentation controller for NanoMVC
 *
 * @package     NanoMVC
 * @author      Nipaa
 * @license     LGPL v2.1 or later
 */

class Doc_Controller extends NanoMVC_Controller {
  public function index(): void  {
    $ar_header = ['title' => 'NanoMVC – Minimalist MVC Framework Documentation',
                  'description' => 'Explore the official NanoMVC documentation. Learn how to install, configure, and use this minimalist PHP MVC framework.'
                 ];
    $this->view->display('index_header', $ar_header);
    $this->view->display('doc_view');
    $this->view->display('index_footer');
  }

  public function overview(): void  {
    $ar_header = ['title' => 'NanoMVC - Overview',
                  'description' => 'Learn the basic file structure of NanoMVC. Understand how the framework is organized and where your application files should go.',
                 ];

    $ar_footer = ['controller' => 'Doc',
                  'method' => 'overview'
                 ];

    $this->view->display('index_header', $ar_header);
    $this->view->display('overview_view');
    $this->view->display('index_footer', $ar_footer);
  }

  public function installation(): void  {
    $ar_header = ['title' => 'NanoMVC - Installation',
                  'description' => 'Learn how to install NanoMVC — from quick setup to shared installations. Follow clear steps for configuring your application and database.',
                 ];

    $ar_footer = ['controller' => 'Doc',
                  'method' => 'installation'
                 ];

    $this->view->display('index_header', $ar_header);
    $this->view->display('installation_view');
    $this->view->display('index_footer', $ar_footer);
  }

  public function controllers(): void {
    $ar_header = ['title' => 'NanoMVC - Controllers',
                  'description' => 'Learn how controllers work in NanoMVC. Understand URL routing, method handling, default and root controllers, and best practices for organizing your application logic.',
                 ];

    $ar_footer = ['controller' => 'Doc',
                  'method' => 'controllers'
                 ];

    $this->view->display('index_header', $ar_header);
    $this->view->display('controllers_view');
    $this->view->display('index_footer', $ar_footer);
  }

  public function views(): void  {
    $ar_header = ['title' => 'NanoMVC - Views',
                  'description' => 'Learn how views work in NanoMVC. Understand view rendering, variable assignment, and capturing output.',
                 ];

    $ar_footer = ['controller' => 'Doc',
                  'method' => 'views'
                 ];

    $this->view->display('index_header', $ar_header);
    $this->view->display('views_view');
    $this->view->display('index_footer', $ar_footer);
  }

  public function models(): void  {
    $ar_header = ['title' => 'NanoMVC - Models',
                  'description' => 'Learn how to use models in NanoMVC to handle data, interact with databases using PDO, and extend functionality with custom plugins.',
                 ];

    $ar_footer = ['controller' => 'Doc',
                  'method' => 'models'
                 ];

    $this->view->display('index_header', $ar_header);
    $this->view->display('models_view');
    $this->view->display('index_footer', $ar_footer);
  }

  public function plugins(): void  {
    $ar_header = ['title' => 'NanoMVC - Plugins',
                  'description' => 'Learn how to extend NanoMVC with plugins. Includes examples of loading libraries and scripts, using helper functions, and organizing reusable logic in your application.',
                 ];

    $ar_footer = ['controller' => 'Doc',
                  'method' => 'plugins'
                 ];

    $this->view->display('index_header', $ar_header);
    $this->view->display('plugins_view');
    $this->view->display('index_footer', $ar_footer);
  }

  public function customdb(): void  {
    $ar_header = ['title' => 'NanoMVC - Custom Database Plugin',
                  'description' => 'Learn how to create a custom database plugin in NanoMVC by extending the built-in PDO class. Modify functionality and use your own logic while maintaining compatibility.',
                 ];

    $ar_footer = ['controller' => 'Doc',
                  'method' => 'customdb'
                 ];

    $this->view->display('index_header', $ar_header);
    $this->view->display('customdb_view');
    $this->view->display('index_footer', $ar_footer);
  }

  public function extending(): void  {
    $ar_header = ['title' => 'NanoMVC - Extending NanoMVC Classes',
                  'description' => 'Learn how to extend NanoMVC core classes like NanoMVC_Controller, NanoMVC_Model, and NanoMVC_View to add your own custom logic and shared functionality across your application.',
                 ];

    $ar_footer = ['controller' => 'Doc',
                  'method' => 'extending'
                 ];

    $this->view->display('index_header', $ar_header);
    $this->view->display('extending_view');
    $this->view->display('index_footer', $ar_footer);
  }

  public function autoload(): void  {
    $ar_header = ['title' => 'NanoMVC - Autoloading Plugins',
                  'description' => 'Learn how to autoload libraries, scripts, and models in NanoMVC so they are always available to your controllers without manual loading. Supports aliases and database pools.',
                 ];

    $ar_footer = ['controller' => 'Doc',
                  'method' => 'autoload'
                 ];

    $this->view->display('index_header', $ar_header);
    $this->view->display('autoload_view');
    $this->view->display('index_footer', $ar_footer);
  }

  public function instances(): void  {
    $ar_header = ['title' => 'NanoMVC - Getting an Instance',
                  'description' => 'Learn how to access the NanoMVC application instance using nmvc::instance(). Useful for working with controllers, views, and configuration outside the controller context.',
                 ];

    $ar_footer = ['controller' => 'Doc',
                  'method' => 'instances'
                 ];

    $this->view->display('index_header', $ar_header);
    $this->view->display('instances_view');
    $this->view->display('index_footer', $ar_footer);
  }

  public function templates(): void  {
    $ar_header = ['title' => 'NanoMVC - Integrating a Template Engine',
                  'description' => 'Learn how to integrate template engines like Smarty in NanoMVC, including manual setup and creating reusable library wrappers.',
                 ];

    $ar_footer = ['controller' => 'Doc',
                  'method' => 'templates'
                 ];

    $this->view->display('index_header', $ar_header);
    $this->view->display('templates_view');
    $this->view->display('index_footer', $ar_footer);
  }

  public function errors(): void  {
    $ar_header = ['title' => 'NanoMVC - Custom Error Handler',
                  'description' => 'Learn how to define a custom error handler in NanoMVC by extending the built-in NanoMVC_ErrorHandler class. Handle system errors and exceptions your way.',
                 ];

    $ar_footer = ['controller' => 'Doc',
                  'method' => 'errors'
                 ];

    $this->view->display('index_header', $ar_header);
    $this->view->display('errors_view');
    $this->view->display('index_footer', $ar_footer);
  }

  public function customcore(): void  {
    $ar_header = ['title' => 'NanoMVC - Customize Core',
                  'description' => 'Learn how to customize the NanoMVC core safely by overriding NanoMVC.php without affecting the main core logic, preserving compatibility with future updates.',
                 ];

    $ar_footer = ['controller' => 'Doc',
                  'method' => 'customcore'
                 ];

    $this->view->display('index_header', $ar_header);
    $this->view->display('customcore_view');
    $this->view->display('index_footer', $ar_footer);
  }

}

?>
