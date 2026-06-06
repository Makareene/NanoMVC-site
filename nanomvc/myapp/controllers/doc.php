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

  protected array $footer;
  public NanoMVC_Library_BlogMenu $menu;
  public NanoMVC_Library_Helper $dh;
  public NanoMVC_Library_URI $uri;

  /**
   * class constructor
   *
   * @access public
   * @param string|null $controller_name
   * @param string|null $action
   */
  public function __construct(?string $controller_name = null, ?string $action = null) {
    parent::__construct($controller_name, $action);
    $this->load->library('URI', 'uri');

    $this->footer = [ 'controller' => ucfirst(strtolower($this->_get_controller()))
                     ,'method'     => strtolower($this->_get_action())
                     ,'uri'        => $this->uri->uri()
                    ];
    $this->load->library('BlogMenu', 'menu');
    $this->load->library('Helper', 'dh');
  }

  /**
   * _prepare_article
   *
   * prepares article header data and footer navigation
   *
   * @access protected
   * @param string $title
   * @return array
   */
  protected function _prepare_article(string $title): array {
    $ar_header = [ 'title' => $this->dh->esc_html($title)
                  ,'uri'   => $this->footer['uri']
                 ];

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
    if ($this->uri->segment(2) !== false) throw new Exception('The default action does not accept any additional parameters.', 404);

    $ar_header = [ 'title'       => $this->dh->esc_html('NanoMVC – Minimalist MVC Framework Documentation')
                  ,'description' => $this->dh->esc_html('Explore the official NanoMVC documentation. Learn how to install, configure, and use this minimalist PHP MVC framework.')
                  ,'uri'         => $this->footer['uri']
                 ];

    $articles = $this->menu->get_articles(null, 'created asc');

    // $this->dh->debug($articles, 'Articles', false, false, true);

    $this->view->display('header', $ar_header);
    $this->view->display('doc', ['articles' => $articles, 'dh' => $this->dh]);
    $this->view->display('footer');
  }

  /**
   * @blog {
   *   "name": "Overview",
   *   "description": "Learn the basic structure of a NanoMVC application. Understand how controllers, models, views, libraries, and configuration files are organized.",
   *   "created": "2025-07-15 08:00"
   * }
   */
  public function overview(): void {
    $ar_header = $this->_prepare_article('NanoMVC - Overview');

    $this->view->display('header', $ar_header);
    $this->view->display('overview');
    $this->view->display('footer', $this->footer);
  }

  /**
   * @blog {
   *   "name": "Installation",
   *   "description": "Learn how to install and configure NanoMVC, including database setup, application configuration, and project structure.",
   *   "created": "2025-07-15 09:00"
   * }
   */
  public function installation(): void {
    $ar_header = $this->_prepare_article('NanoMVC - Installation');

    $this->view->display('header', $ar_header);
    $this->view->display('installation');
    $this->view->display('footer', $this->footer);
  }

  /**
   * @blog {
   *   "name": "Controllers",
   *   "description": "Learn how controllers work in NanoMVC. Understand routing, actions, constructors, request handling, and application flow.",
   *   "created": "2025-07-15 10:00"
   * }
   */
  public function controllers(): void {
    $ar_header = $this->_prepare_article('NanoMVC - Controllers');

    $this->view->display('header', $ar_header);
    $this->view->display('controllers');
    $this->view->display('footer', $this->footer);
  }

  /**
   * @blog {
   *   "name": "Views",
   *   "description": "Learn how views work in NanoMVC. Understand rendering, variable assignment, layouts, view discovery, and output generation.",
   *   "created": "2025-07-15 11:00"
   * }
   */
  public function views(): void {
    $ar_header = $this->_prepare_article('NanoMVC - Views');

    $this->view->display('header', $ar_header);
    $this->view->display('views');
    $this->view->display('footer', $this->footer);
  }

  /**
   * @blog {
   *   "name": "Models",
   *   "description": "Learn how models work in NanoMVC. Understand model loading, model discovery, database access, business logic organization, and custom database pools.",
   *   "created": "2025-07-15 12:00"
   * }
   */
  public function models(): void {
    $ar_header = $this->_prepare_article('NanoMVC - Models');

    $this->view->display('header', $ar_header);
    $this->view->display('models');
    $this->view->display('footer', $this->footer);
  }

  /**
   * legacy redirect
   *
   * @access public
   */
  public function plugins(): void {
    $this->dh->redirect('/' . strtolower($this->footer['controller']) . '/libraries', 301);
  }

  /**
   * @blog {
   *   "name": "Libraries",
   *   "description": "Learn how to extend NanoMVC with reusable libraries. Understand library loading, aliases, helper classes, and application organization.",
   *   "created": "2025-07-15 12:30"
   * }
   */
  public function libraries(): void {
    $ar_header = $this->_prepare_article('NanoMVC - Libraries');

    $this->view->display('header', $ar_header);
    $this->view->display('libraries');
    $this->view->display('footer', $this->footer);
  }

  /**
   * @blog {
   *   "name": "Custom Database Plugin",
   *   "description": "Learn how to create custom database plugins by extending the built-in PDO implementation while maintaining framework compatibility.",
   *   "created": "2025-07-15 13:00"
   * }
   */
  public function customdb(): void {
    $ar_header = $this->_prepare_article('NanoMVC - Custom Database Plugin');

    $this->view->display('header', $ar_header);
    $this->view->display('customdb');
    $this->view->display('footer', $this->footer);
  }

  /**
   * @blog {
   *   "name": "Extending NanoMVC Classes",
   *   "description": "Learn how to extend NanoMVC core classes such as NanoMVC_Controller, NanoMVC_Model, NanoMVC_View, and other framework components.",
   *   "created": "2025-07-15 14:00"
   * }
   */
  public function extending(): void {
    $ar_header = $this->_prepare_article('NanoMVC - Extending NanoMVC Classes');

    $this->view->display('header', $ar_header);
    $this->view->display('extending');
    $this->view->display('footer', $this->footer);
  }

  /**
   * @blog {
   *   "name": "Autoloading",
   *   "description": "Learn how to autoload libraries and models in NanoMVC, making them available automatically throughout your application.",
   *   "created": "2025-07-15 15:00"
   * }
   */
  public function autoload(): void {
    $ar_header = $this->_prepare_article('NanoMVC - Autoloading');

    $this->view->display('header', $ar_header);
    $this->view->display('autoload');
    $this->view->display('footer', $this->footer);
  }

  /**
   * @blog {
   *   "name": "Getting an Instance",
   *   "description": "Learn how to access NanoMVC instances through nmvc::instance() and work with framework components outside controller contexts.",
   *   "created": "2025-07-15 16:00"
   * }
   */
  public function instances(): void {
    $ar_header = $this->_prepare_article('NanoMVC - Getting an Instance');

    $this->view->display('header', $ar_header);
    $this->view->display('instances');
    $this->view->display('footer', $this->footer);
  }

  /**
   * @blog {
   *   "name": "Template Engines",
   *   "description": "Learn how to integrate template engines such as Smarty and create reusable wrappers for your preferred rendering system.",
   *   "created": "2025-07-15 17:00"
   * }
   */
  public function templates(): void {
    $ar_header = $this->_prepare_article('NanoMVC - Template Engines');

    $this->view->display('header', $ar_header);
    $this->view->display('templates');
    $this->view->display('footer', $this->footer);
  }

  /**
   * @blog {
   *   "name": "Custom Error Handler",
   *   "description": "Learn how to create custom error handlers by extending NanoMVC_ErrorHandler and controlling how errors and exceptions are displayed.",
   *   "created": "2025-07-15 18:00"
   * }
   */
  public function errors(): void {
    $ar_header = $this->_prepare_article('NanoMVC - Custom Error Handler');

    $this->view->display('header', $ar_header);
    $this->view->display('errors');
    $this->view->display('footer', $this->footer);
  }

  /**
   * @blog {
   *   "name": "Customize Core",
   *   "description": "Learn how to customize NanoMVC safely while preserving compatibility with future framework updates.",
   *   "created": "2025-07-15 19:00"
   * }
   */
  public function customcore(): void {
    $ar_header = $this->_prepare_article('NanoMVC - Customize Core');

    $this->view->display('header', $ar_header);
    $this->view->display('customcore');
    $this->view->display('footer', $this->footer);
  }

  /**
   * @blog {
   *   "name": "BlogMenu",
   *   "description": "Learn how to build blogs and documentation sites using BlogMenu metadata stored directly in controllers and methods.",
   *   "created": "2025-08-03 22:30"
   * }
   */
  public function blogmenu(): void {
    $ar_header = $this->_prepare_article('NanoMVC - BlogMenu');

    $this->view->display('header', $ar_header);
    $this->view->display('blogmenu');
    $this->view->display('footer', $this->footer);
  }

  /**
   * legacy redirect
   *
   * @access public
   */
  public function usefulplugins(): void {
    $this->dh->redirect('/' . strtolower($this->footer['controller']) . '/usefullibraries', 301);
  }

  /**
   * @blog {
   *   "name": "Useful Libraries",
   *   "description": "Explore useful NanoMVC libraries such as URI, Helper, and BlogMenu. Learn practical techniques for routing, debugging, redirects, view rendering, and application development.",
   *   "created": "2025-08-04 00:30"
   * }
   */
  public function usefullibraries(): void {
    $ar_header = $this->_prepare_article('NanoMVC - Useful Libraries');

    $this->view->display('header', $ar_header);
    $this->view->display('usefullibraries');
    $this->view->display('footer', $this->footer);
  }

  /**
   * @blog {
   *   "name": "Examples",
   *   "description": "Explore real-world NanoMVC projects, including the official documentation website, personal blogs, and application examples.",
   *   "created": "2025-08-11 11:00"
   * }
   */
  public function examples(): void {
    $ar_header = $this->_prepare_article('NanoMVC - Examples');

    $this->view->display('header', $ar_header);
    $this->view->display('examples');
    $this->view->display('footer', $this->footer);
  }

}

?>
