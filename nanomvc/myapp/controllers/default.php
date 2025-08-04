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

  public function index(): void  {
    $this->load->library('URI', 'uri');
    if ($this->uri->segment(1) !== false) throw new Exception('The default controller does not accept any additional parameters.', 404);

    $ar_header = ['title' => 'NanoMVC - Lightweight PHP Framework',
                  'description' => 'NanoMVC is a lightweight PHP MVC framework for fast and minimal web development. Inspired by TinyMVC, perfect for small to medium projects.'];
    $this->view->display('index_header', $ar_header);
    $this->view->display('index_view');
    $this->view->display('index_footer');
  }
}

?>
