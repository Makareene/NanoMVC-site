<h1>Autoload</h1>

<h2>Autoloading Plugins</h2>
<p>Instead of calling <code>$this->load->library()</code> and <code>$this->load->script()</code> in each controller, you can autoload them so they're always available to every controller by default.</p>

<h3>Configuration</h3>
<p>Edit your autoload configuration file:</p>
<pre><code>/myapp/configs/config_autoload.php</code></pre>

<h3>Auto-loaded Libraries</h3>
<pre><code>$config['libraries'] = ['mylib', 'myotherlib'];</code></pre>
<p>If you want to alias a library, use an array with two values: the plugin name and the alias:</p>
<pre><code>$config['libraries'] = [
  ['mylib', 'myalias'],
  ['myotherlib', 'otheralias']
];</code></pre>

<h3>Auto-loaded Scripts</h3>
<pre><code>$config['scripts'] = ['myhelpers', 'myscripts'];</code></pre>
<p>Script plugins are included globally and their functions are available across all controllers and views.</p>

<h3>Auto-loaded Models</h3>
<pre><code>$config['models'] = ['mymodel', 'monewmodel'];</code></pre>
<p>You can also autoload models with aliases and specify a connection pool:</p>
<pre><code>$config['models'] = [
  ['mymodel', 'mymodelalias', 'mypool'],
  ['monewmodel', 'mynewmodelalias', 'mynewpool']
];</code></pre>

<h3>Declaring Aliases in Your Controllers</h3>
<p>To use aliased models and libraries, be sure to declare their properties in your controller. The best way is to extend your base controller and define all the necessary aliases there.</p>
<p>Example:</p>
<pre><code>class My_Controller extends NanoMVC_Controller {
  public $mymodelalias;
  public $mynewmodelalias;
  public $myalias;
  public $otheralias;

  // Add your common controller logic here
}</code></pre>

<p>Then simply extend <code>My_Controller</code> in your controllers instead of <code>NanoMVC_Controller</code>. For instructions on extending controllers, see the <a href="/doc/extending">Extending NanoMVC Classes</a> documentation.</p>
