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

  public array $footer;
  public NanoMVC_Library_BlogMenu $menu;
  private NanoMVC_Script_Helper $dh;
  private array $nav_article;
  public NanoMVC_Library_URI $uri;

  public function __construct() {
    parent::__construct();
    $this->load->library('BlogMenu', 'menu');
    $this->load->script('helper');
    $this->dh = new NanoMVC_Script_Helper();
  }

  private function _get_preparticle(string $title): array {
    $this->footer = [
      'controller' => ucfirst(strtolower($this->_get_controller())),
      'method'     => strtolower($this->_get_action())
    ];
    $ar_header = ['title' => $this->dh->esc_html($title)];
    $action = $this->footer['method'];
    $articles = $this->menu->get_articles(null, 'created asc');

    $this->footer['nav'] = $this->menu->get_nav($articles, $action);
    if ($this->footer['nav']['pre']) {
      $this->footer['nav']['pre']['name'] = $this->dh->esc_html($this->footer['nav']['pre']['name']);
      $this->footer['nav']['pre']['_link'] = $this->dh->esc_html($this->footer['nav']['pre']['_link']);
    }
    if ($this->footer['nav']['next']) {
      $this->footer['nav']['next']['name'] = $this->dh->esc_html($this->footer['nav']['next']['name']);
      $this->footer['nav']['next']['_link'] = $this->dh->esc_html($this->footer['nav']['next']['_link']);
    }

    if (isset($articles[$action]['description'])) $ar_header['description'] = $this->dh->esc_html($articles[$action]['description']);

    return $ar_header;
  }

  public function index(): void {
    $this->load->library('URI', 'uri');
    if ($this->uri->segment(2) !== false) throw new Exception('The default action does not accept any additional parameters.', 404);

    $ar_header = ['title' => $this->dh->esc_html('NanoMVC – Minimalist MVC Framework Documentation'),
                  'description' => $this->dh->esc_html('Explore the official NanoMVC documentation. Learn how to install, configure, and use this minimalist PHP MVC framework.')
                 ];

    $articles = $this->menu->get_articles(null, 'created asc');

    foreach ($articles as &$article) {
      $article['name'] = $this->dh->esc_html($article['name']);
      $article['description'] = $this->dh->esc_html($article['description']);
      $article['_link'] = $this->dh->esc_html($article['_link']);
    }
    unset($article);

    // $this->dh->debug($articles, 'Articles', false, false, true);

    $this->view->display('index_header', $ar_header);
    $this->view->display('doc_view', ['articles' => $articles]);
    $this->view->display('index_footer');
  }

  /**
   * @blog {
   *   "name": "Overview",
   *   "description": "Learn the basic file structure of NanoMVC. Understand how the framework is organized and where your application files should go.",
   *   "created": "2025-07-15 08:00"
   * }
   */
  public function overview(): void {
    $ar_header = $this->_get_preparticle('NanoMVC - Overview');

    $this->view->display('index_header', $ar_header);
    $this->view->display('overview_view');
    $this->view->display('index_footer', $this->footer);
  }

  /**
   * @blog {
   *   "name": "Installation",
   *   "description": "Learn how to install NanoMVC — from quick setup to shared installations. Follow clear steps for configuring your application and database.",
   *   "created": "2025-07-15 09:00"
   * }
   */
  public function installation(): void {
    $ar_header = $this->_get_preparticle('NanoMVC - Installation');

    $this->view->display('index_header', $ar_header);
    $this->view->display('installation_view');
    $this->view->display('index_footer', $this->footer);
  }

  /**
   * @blog {
   *   "name": "Controllers",
   *   "description": "Learn how controllers work in NanoMVC. Understand URL routing, method handling, default and root controllers, and best practices for organizing your application logic.",
   *   "created": "2025-07-15 10:00"
   * }
   */
  public function controllers(): void {
    $ar_header = $this->_get_preparticle('NanoMVC - Controllers');

    $this->view->display('index_header', $ar_header);
    $this->view->display('controllers_view');
    $this->view->display('index_footer', $this->footer);
  }

  /**
   * @blog {
   *   "name": "Views",
   *   "description": "Learn how views work in NanoMVC. Understand view rendering, variable assignment and capturing output.",
   *   "created": "2025-07-15 11:00"
   * }
   */
  public function views(): void {
    $ar_header = $this->_get_preparticle('NanoMVC - Views');

    $this->view->display('index_header', $ar_header);
    $this->view->display('views_view');
    $this->view->display('index_footer', $this->footer);
  }

  /**
   * @blog {
   *   "name": "Models",
   *   "description": "Learn how to use models in NanoMVC to handle data, interact with databases using PDO, and extend functionality with custom plugins.",
   *   "created": "2025-07-15 12:00"
   * }
   */
  public function models(): void {
    $ar_header = $this->_get_preparticle('NanoMVC - Models');

    $this->view->display('index_header', $ar_header);
    $this->view->display('models_view');
    $this->view->display('index_footer', $this->footer);
  }

  /**
   * @blog {
   *   "name": "Plugins",
   *   "description": "Learn how to extend NanoMVC with plugins. Includes examples of loading libraries and scripts, using helper functions, and organizing reusable logic in your application.",
   *   "created": "2025-07-15 12:00"
   * }
   */
  public function plugins(): void {
    $ar_header = $this->_get_preparticle('NanoMVC - Plugins');

    $this->view->display('index_header', $ar_header);
    $this->view->display('plugins_view');
    $this->view->display('index_footer', $this->footer);
  }

  /**
   * @blog {
   *   "name": "Custom Database Plugin",
   *   "description": "Learn how to create a custom database plugin in NanoMVC by extending the built-in PDO class. Modify functionality and use your own logic while maintaining compatibility.",
   *   "created": "2025-07-15 13:00"
   * }
   */
  public function customdb(): void {
    $ar_header = $this->_get_preparticle('NanoMVC - Custom Database Plugin');

    $this->view->display('index_header', $ar_header);
    $this->view->display('customdb_view');
    $this->view->display('index_footer', $this->footer);
  }

  /**
   * @blog {
   *   "name": "Extending NanoMVC Classes",
   *   "description": "Learn how to extend NanoMVC core classes like NanoMVC_Controller, NanoMVC_Model, and NanoMVC_View to add your own custom logic and shared functionality across your application.",
   *   "created": "2025-07-15 14:00"
   * }
   */
  public function extending(): void {
    $ar_header = $this->_get_preparticle('NanoMVC - Extending NanoMVC Classes');

    $this->view->display('index_header', $ar_header);
    $this->view->display('extending_view');
    $this->view->display('index_footer', $this->footer);
  }

  /**
   * @blog {
   *   "name": "Autoloading Plugins",
   *   "description": "Learn how to autoload libraries, scripts, and models in NanoMVC so they are always available to your controllers without manual loading. Supports aliases and database pools.",
   *   "created": "2025-07-15 15:00"
   * }
   */
  public function autoload(): void {
    $ar_header = $this->_get_preparticle('NanoMVC - Autoloading Plugins');

    $this->view->display('index_header', $ar_header);
    $this->view->display('autoload_view');
    $this->view->display('index_footer', $this->footer);
  }

  /**
   * @blog {
   *   "name": "Getting an Instance",
   *   "description": "Learn how to access the NanoMVC application instance using nmvc::instance(). Useful for working with controllers, views, and configuration outside the controller context.",
   *   "created": "2025-07-15 16:00"
   * }
   */
  public function instances(): void {
    $ar_header = $this->_get_preparticle('NanoMVC - Getting an Instance');

    $this->view->display('index_header', $ar_header);
    $this->view->display('instances_view');
    $this->view->display('index_footer', $this->footer);
  }

  /**
   * @blog {
   *   "name": "Integrating a Template Engine",
   *   "description": "Learn how to integrate template engines like Smarty in NanoMVC, including manual setup and creating reusable library wrappers.",
   *   "created": "2025-07-15 17:00"
   * }
   */
  public function templates(): void {
    $ar_header = $this->_get_preparticle('NanoMVC - Integrating a Template Engine');

    $this->view->display('index_header', $ar_header);
    $this->view->display('templates_view');
    $this->view->display('index_footer', $this->footer);
  }

  /**
   * @blog {
   *   "name": "Custom Error Handler",
   *   "description": "Learn how to define a custom error handler in NanoMVC by extending the built-in NanoMVC_ErrorHandler class. Handle system errors and exceptions your way.",
   *   "created": "2025-07-15 18:00"
   * }
   */
  public function errors(): void {
    $ar_header = $this->_get_preparticle('NanoMVC - Custom Error Handler');

    $this->view->display('index_header', $ar_header);
    $this->view->display('errors_view');
    $this->view->display('index_footer', $this->footer);
  }

  /**
   * @blog {
   *   "name": "Customize Core",
   *   "description": "Learn how to customize the NanoMVC core safely by overriding NanoMVC.php without affecting the main core logic, preserving compatibility with future updates.",
   *   "created": "2025-07-15 19:00"
   * }
   */
  public function customcore(): void {
    $ar_header = $this->_get_preparticle('NanoMVC - Customize Core');

    $this->view->display('index_header', $ar_header);
    $this->view->display('customcore_view');
    $this->view->display('index_footer', $this->footer);
  }

  /**
   * @blog {
   *   "name": "BlogMenu Plugin",
   *   "description": "BlogMenu plugin lets you structure and retrieve blog categories and articles from your NanoMVC controllers using simple metadata.",
   *   "created": "2025-08-03 22:30"
   * }
   */
  public function blogmenu(): void {
    $ar_header = $this->_get_preparticle('NanoMVC - BlogMenu Plugin');

    $this->view->display('index_header', $ar_header);
    $this->view->display('blogmenu_view');
    $this->view->display('index_footer', $this->footer);
  }

  /**
   * @blog {
   *   "name": "Useful Plugins",
   *   "description": "Explore essential NanoMVC plugins like URI and Script Helper. Learn how to work with URL segments, perform redirection, debug variables, and send custom headers efficiently.",
   *   "created": "2025-08-04 00:30"
   * }
   */
  public function usefulplugins(): void {
    $ar_header = $this->_get_preparticle('NanoMVC - Useful Plugins');

    $this->view->display('index_header', $ar_header);
    $this->view->display('usefulplugins_view');
    $this->view->display('index_footer', $this->footer);
  }

}

?>
