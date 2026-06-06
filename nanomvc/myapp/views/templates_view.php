<h1>Integrating a Template Engine</h1>

<p>
NanoMVC does not require a template engine, but you may prefer one for more advanced presentation logic.
This example demonstrates integration with Smarty, but the same approach can be used for any third-party template engine.
</p>

<h2>Install the Template Engine</h2>

<p>
Assume Smarty is installed outside the NanoMVC directory:
</p>

<pre><code>/var/smarty/
  /libs/
    Smarty.class.php
  /templates/
  /templates_c/
  /configs/
  /cache/
</code></pre>

<p>
Keeping third-party projects outside NanoMVC allows them to remain independent and receive updates from their original repositories.
</p>

<h2>Autoload the External Class</h2>

<p>
Add the Smarty class file to the NanoMVC autoload configuration:
</p>

<pre><code>// File: /myapp/configs/&#8203;config_application.php

return [

  // Autoload files
 ,'autoload' => [
    DS . 'var' . DS . 'smarty' . DS . 'libs' . DS . 'Smarty.class.php'
  ]

];</code></pre>

<p>
NanoMVC will automatically include the file during startup.
</p>

<h2>Create a NanoMVC Wrapper Library</h2>

<p>
Create a NanoMVC library that extends the original Smarty class:
</p>

<pre><code>// File: /myapp/plugins/nanomvc&#8203;_library_smarty_wrapper.php

define('SMARTY_SPL_AUTOLOAD', true);

class NanoMVC_Library_Smarty_Wrapper extends Smarty {

  public function __construct() {
    parent::__construct();

    $this->setTemplateDir(&#8203;'/var/smarty/templates/');
    $this->setCompileDir(&#8203;'/var/smarty/templates_c/');
    $this->setConfigDir(&#8203;'/var/smarty/configs/');
    $this->setCacheDir(&#8203;'/var/smarty/cache/');
  }

}</code></pre>

<p>
This keeps all Smarty-specific configuration in one place.
</p>

<h2>Using the Wrapper</h2>

<p>
Load the wrapper like any other NanoMVC library:
</p>

<pre><code>class Hello_Controller extends NanoMVC_Controller {

  public NanoMVC_Library_Smarty_Wrapper $smarty;

  public function index(): void {
    $this->load->library(&#8203;'Smarty_Wrapper', 'smarty');

    $this->smarty->assign('foo', 'bar');
    $this->smarty->display(&#8203;'hello.tpl');
  }

}</code></pre>

<h2>Why Use a Wrapper?</h2>

<p>
A wrapper library keeps third-party code separate from NanoMVC code.
The external project can be updated independently, while NanoMVC-specific configuration and helper methods remain inside your wrapper.
</p>

<p>
This approach works not only for Smarty, but for any external PHP project that provides classes you want to use from NanoMVC.
</p>
