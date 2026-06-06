<?php

/**
 * default.php
 *
 * Default application controller for NanoMVC - this is a main page.
 *
 * @package     NanoMVC
 * @author      Monte Ohrt (original), Nipaa (modifications)
 * @license     LGPL v2.1 or later
 */

class Default_Controller extends NanoMVC_Controller {
  public NanoMVC_Library_URI $uri;
  public NanoMVC_Library_Helper $dh;

  /**
   * class constructor
   *
   * @access public
   * @param string|null $controller_name
   * @param string|null $action
   */
  public function __construct(?string $controller_name = null, ?string $action = null) {
    parent::__construct($controller_name, $action);
  }

  /**
   * index
   *
   * main page
   *
   * @access public
   */
  public function index(): void {
    $this->load->library('URI', 'uri');
    $this->load->library('Helper', 'dh');

    $uri = $this->uri->uri();

    if ($this->uri->segment(1) !== false)
      throw new Exception('The default controller does not accept any additional parameters.', 404);

    $ar_header = [ 'title'       => $this->dh->esc_html('NanoMVC - Lightweight PHP Framework')
                  ,'description' => $this->dh->esc_html('NanoMVC is a lightweight PHP MVC framework for fast and minimal web development. Inspired by TinyMVC, perfect for small to medium projects.')
                  ,'uri'         => $uri
                 ];

    $this->view->display('header', $ar_header);
    $this->view->display('index');
    $this->view->display('footer', ['uri' => $uri]);
  }

}

?>
