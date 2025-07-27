<h1>Plugins</h1>

<h2>What is a plugin?</h2>
<p>Plugins are used to extend the functionality of NanoMVC. There are two main types of plugins:</p>
<ul>
  <li><strong>Libraries</strong> — PHP classes that are instantiated via the loader.</li>
  <li><strong>Scripts</strong> — Plain PHP scripts that are included at runtime.</li>
</ul>
<p>Both types of plugins are placed in the <code>/myapp/plugins/</code> directory.</p>

<h2>Loading a Library</h2>
<p>Let’s create a sample library plugin named <code>demo</code>:</p>
<pre><code>/myapp/
  /plugins/
    nanomvc_library_demo.php</code></pre>
<p>The filename must be lowercase and follow the pattern <code>nanomvc_library_*.php</code>. The class name must match the filename suffix and start with <code>NanoMVC_Library_</code>:</p>
<pre><code>class NanoMVC_Library_Demo {
  public function test() {
    return "This is a test.";
  }
}</code></pre>

<p>To use this plugin in a controller:</p>
<pre><code>class Hello_Controller extends NanoMVC_Controller {
  public NanoMVC_Library_Demo $mydemo;

  function index() {
    $this->load->library('demo', 'mydemo');
    $this->view->assign('output', $this->mydemo->test());
    $this->view->display('hello_view');
  }
}</code></pre>
<p>The second argument to <code>load-&gt;library()</code> is an alias for the class instance. If not provided, the original name is used.</p>
<p>You now have a variable <code>$output</code> in your view with the result of the <code>test()</code> method.</p>

<h2>Loading a Script</h2>
<p>Let’s create a script plugin called <code>myhelpers</code>:</p>
<pre><code>/myapp/
  /plugins/
    nanomvc_script_myhelpers.php</code></pre>
<p>The script file must be lowercase and start with <code>nanomvc_script_</code>.</p>
<pre><code>function esc($string) {
  return htmlentities($string);
}

function anchor($url, $text) {
  return "&lt;a href=\"$url\"&gt;$text&lt;/a&gt;";
}</code></pre>

<p>To load the script in a controller:</p>
<pre><code>class Hello_Controller extends NanoMVC_Controller {
  function index() {
    $this->load->script('myhelpers');
    $this->view->display('hello_view');
  }
}</code></pre>

<p>All functions defined in the script become globally available to views and controllers after loading.</p>

<p>Optionally, you may use static classes instead of global functions. For example:</p>
<pre><code>class NanoMVC_Script_Helper {
  public static function esc($str) {
    return htmlentities($str);
  }
}</code></pre>
<p>Then use it as follows after loading the script:</p>
<pre><code>// Call statically
echo NanoMVC_Script_Helper::esc('&lt;div&gt;test&lt;/div&gt;');

// Or as an instance (for brevity)
$dh = new NanoMVC_Script_Helper();
echo $dh::esc('&lt;div&gt;test&lt;/div&gt;');</code></pre>

<p>Libraries and scripts can optionally be autoloaded. See the <a href="/doc/autoload">Autoloading plugins</a> for more details.</p>

<p><a href="/doc/models" class="btn-download">&larr; Return to Models</a> <a href="/doc/customdb" class="btn-download">Continue to Custom Database Plugin &rarr;</a></p>
