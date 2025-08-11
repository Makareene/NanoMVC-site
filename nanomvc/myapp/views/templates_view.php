<h1>Integrating a Template Engine</h1>
<p>
NanoMVC does not require a template engine, but you may prefer to use one for more advanced presentation logic.
In this example, we'll integrate <a href="https://github.com/smarty-php/smarty" target="_blank" rel="nofollow">Smarty</a> as a view layer.
</p>

<h2>Quick Setup Example</h2>
<p>
Make sure Smarty is installed and working correctly. In this example, the directory structure is as follows:
</p>

<pre><code>/var/smarty/
  /libs/
    Smarty.class.php
    ...
  /templates/
  /templates_c/
  /configs/
  /cache/
</code></pre>

<p>Create a controller using Smarty directly:</p>

<pre><code>/myapp/controllers/&#8203;hello.php

class Hello_Controller extends NanoMVC_Controller {
  public $smarty;
  function index() {
    // Allow NanoMVC and Smarty to cooperate with autoloaders
    define('SMARTY_SPL_AUTOLOAD', 1);

    // Load Smarty manually
    require('/var/smarty/&#8203;libs/Smarty.class.php');

    // Load as a plugin
    $this->load->library(&#8203;'Smarty', 'smarty');

    // Configure Smarty
    $this->smarty->setTemplateDir(&#8203;'/var/smarty/templates/');
    $this->smarty->setCompileDir(&#8203;'/var/smarty/templates_c/');
    $this->smarty->setConfigDir(&#8203;'/var/smarty/configs/');
    $this->smarty->setCacheDir(&#8203;'/var/smarty/cache/');

    // Use Smarty for rendering
    $this->smarty->assign('foo', 'bar');
    $this->smarty->display(&#8203;'hello_view.tpl');
  }
}
</code></pre>

<p>
Note: If a class with the same name already exists, NanoMVC will not attempt to load a plugin for it.
</p>

<h2>Recommended: Create a Wrapper Plugin</h2>
<p>
Instead of repeating setup code in every controller, it’s cleaner to create a wrapper plugin around Smarty:
</p>

<pre><code>/myapp/plugins/nanomvc_&#8203;library_smarty_wrapper.php

define('SMARTY_SPL_AUTOLOAD', 1);
require('/var/smarty/&#8203;libs/Smarty.class.php');

class NanoMVC_Library_&#8203;Smarty_Wrapper extends Smarty {
  function __construct() {
    parent::__construct();
    $this->setTemplateDir(&#8203;'/var/smarty/templates/');
    $this->setCompileDir(&#8203;'/var/smarty/templates_c/');
    $this->setConfigDir(&#8203;'/var/smarty/configs/');
    $this->setCacheDir(&#8203;'/var/smarty/cache/');
  }
}
</code></pre>

<p>Then update your controller to use the wrapper:</p>

<pre><code>/myapp/controllers/hello.php

class Hello_Controller extends NanoMVC_Controller {
  function index() {
    $this->load->library(&#8203;'Smarty_Wrapper', 'smarty');
    $this->smarty->assign('foo', 'bar');
    $this->smarty->display(&#8203;'hello_view.tpl');
  }
}
</code></pre>

<h2>Autoloading Option</h2>
<p>
You can autoload your <code>Smarty_Wrapper</code> by adding it to the autoload configuration file:
</p>

<pre><code>/myapp/configs/&#8203;config_autoload.php

$config['libraries'] = ['Smarty_Wrapper'];
</code></pre>

<p>
This allows you to access Smarty in any controller without having to load it manually.
See the <a href="/doc/autoload">Autoloading documentation</a> for more details.
</p>
