<h1>Controllers</h1>

<h2>What is a controller?</h2>
<p>Controller files are what glue the application together. They load models, display views, and tie in the plugins and application library code. They are the content traffic cops, so to speak.</p>

<p>A typical URL to a NanoMVC page looks like this:</p>
<pre><code>http://[host]/&#8203;index.php/&#8203;[controller]/&#8203;[action]/[param1]/&#8203;[param2]/[param3...]</code></pre>
<p>Where the <code>[controller]</code> is the name of the controller file/class, and <code>[action]</code> is the method name you want to access. Additional values are used as parameters.</p>
<p>Example:</p>
<pre><code>http://localhost/&#8203;index.php/hello/&#8203;intro/name/joe</code></pre>

<h2>Learning by example</h2>
<p>Controller files live in the <code>/myapp/controllers/</code> directory. Let's create a controller:</p>
<pre><code>/myapp/
  /controllers/
    hello.php</code></pre>

<pre><code>class Hello_Controller extends NanoMVC_Controller {
  function index() {
    echo "Hello World.";
  }
}</code></pre>

<p><strong>Note:</strong> Ideally, controllers should not contain <code>echo</code> statements or any direct output. The example above is a basic demonstration. Proper examples using views are available in the <b>Views</b> section.</p>

<p>The controller name in the URL is <strong>case-insensitive</strong> and should not include the <code>.php</code> extension.<br> The controller file must always be named in lowercase (e.g. <code>default.php</code>). Inside the file, the controller class must end with the suffix <code>_Controller</code>, and the class name casing does not matter.</p>
<p>You can request a controller using any casing in the URL, such as <code>/Default</code>, <code>/DEFAULT</code>, or <code>/default</code> — all will resolve to the same controller file.</p>
<p>Inside controller methods, you can retrieve the controller name as it was written in the URL using:</p>
<pre><code>$this->_get_controller();</code></pre>
<p>This will reflect the original casing, such as <code>default</code>, <code>Default</code>, or <code>DEFAULT</code>.</p>
<p>To get the controller class name as defined in code (with its original casing), use the PHP magic constant:</p>
<pre><code>echo __CLASS__;</code></pre>
<p>Example: <code>Default_Controller</code></p>

<p>Now visit:</p>
<pre><code>http://localhost/index.php/hello</code></pre>
<p>You should see <code>Hello World.</code> in your browser.</p>

<p>If no controller is specified in the URL, <code>default</code> is assumed. This can be changed in <code>/myapp/configs/config_application.php</code>. See the "Default Controller" section below.</p>

<p>Now let’s add another method to our controller:</p>
<pre><code>class Hello_Controller extends NanoMVC_Controller {
  function index() {
    echo "Hello World.";
  }

  function time() {
    echo "The time is now.";
  }
}</code></pre>

<p>Then access it via:</p>
<pre><code>http://localhost/&#8203;index.php/hello/time</code></pre>
<p>As you can see, appending the method name executes the corresponding method.</p>
<p>If no method is given, the default <code>index</code> method is used.</p>

<h3>Removing index.php from the URL</h3>
<p>You can clean up the URL using this Apache rewrite rule:</p>
<pre><code>RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]</code></pre>
<p>Place this in your <code>.htaccess</code> or server config. Then, instead of <code>/index.php/hello</code> you can simply use:</p>
<pre><code>http://localhost/hello</code></pre>

<p>Make sure to add a <code>robots.txt</code> and <code>favicon.ico</code> file to avoid unnecessary rewrites when bots or browsers request those resources.</p>

<h2>About Method Case Sensitivity</h2>
<p>Controller method names in NanoMVC are case-insensitive, as defined by PHP itself.<br>
You can call:</p>
<ul>
  <li><code>/Page/index</code></li>
  <li><code>/Page/Index</code></li>
  <li><code>/Page/INDEX</code></li>
</ul>
<p>— all will resolve to the same method.</p>
<p>However, PHP does <strong>not</strong> allow declaring two methods that differ only by case (e.g., <code>index()</code> and <code>Index()</code>).</p>
<p>To handle case-specific logic, you can use the method name as defined in the controller using <code>__FUNCTION__</code> and compare it to the original method name extracted from the URL in your router.</p>
<p>To get the action name from the URL, use the <code>_get_action()</code> method. See the example below:</p>

<pre><code>class Case_Controller extends NanoMVC_Controller {
  function Index() {
    if (__FUNCTION__ === $this->_get_action())
      echo 'the same';
    elseif ($this->_get_action() === 'INDEX')
      echo 'CAPS';
    elseif ($this->_get_action() === 'index')
      echo 'lower';
    else
      throw new Exception("Unknown controller method '{$this->_get_action()}'");
  }
}
</code></pre>

<h2>Allowed Characters in Names</h2>
<p>Controller and method names must contain only word characters: <code>[a-zA-Z0-9_]</code>. Any name containing special characters, spaces, or symbols outside of this pattern will be rejected and may cause routing errors.</p>
<p>This constraint ensures predictable routing and avoids issues with file naming and method resolution in PHP.</p>

<h2>Uncallable Methods</h2>
<p>In NanoMVC, certain methods cannot be called directly via a URL. These are called <strong>uncallable methods</strong>, and their names start with an underscore (<code>_</code>).</p>
<p>This behavior is inherited from TinyMVC and is reserved both for internal system use and user-defined helpers. You can safely define private or utility methods inside your controllers with a leading underscore, knowing they won't be exposed to routing or executed externally.</p>
<pre><code>class User_Controller extends NanoMVC_Controller {
  function profile() {
    $this->_log_access(); // call internal helper
    $this->view->display(&#8203;'user_profile_view'); // show the view
  }

  function _log_access() {
    // This method cannot be accessed from URL
    // but is available internally
  }
}</code></pre>

<h2>Default Controller</h2>
<p>If no controller is given in the URL, NanoMVC uses the <code>default</code> controller and the <code>index</code> action by default.</p>
<p>You can customize this here:</p>
<pre><code>/nanomvc/
  /myapp/
    /configs/
      config_application.php</code></pre>

<pre><code>/* name of default controller/method when none is given in the URL */
$config['default_controller'] = 'mycontroller';
$config['default_action'] = 'myaction';</code></pre>

<h2>Root Controller</h2>
<p>If you want to force all requests to go through a specific controller and method regardless of the URL, you can configure that here:</p>
<pre><code>/nanomvc/
  /myapp/
    /configs/
      config_application.php</code></pre>

<pre><code>/* set this to force controller and method instead of using URL params */
$config['root_controller'] = 'myroot';
$config['root_action'] = 'myaction';</code></pre>
<p>The <code>root_controller</code> takes precedence over the default controller and overrides any controller provided in the URL.</p>
<p>Both <code>root_controller</code> and <code>root_action</code> can be used independently. For example, you may want to override only the action globally, but keep the standard controller logic from the URL.</p>

<h2>URL Routing</h2>
<p>You can route or map user-friendly URLs to other internal URLs using the routing feature. This is done by providing arrays of regular expression patterns and their replacements, compatible with <code>preg_replace()</code>.</p>

<pre><code>/nanomvc/
  /myapp/
    /configs/
      config_application.php</code></pre>

<pre><code>/* URL routing, use preg_replace() compatible syntax */
$config['routing']['search'] = array('!/foo/(\d+)!');
$config['routing']['replace'] = array('/foo/index/${1}');</code></pre>

<p>This example rewrites <code>/foo/123</code> into <code>/foo/index/123</code> before routing to the controller.</p>

<p>You can use a wide range of regular expressions beyond <code>\w</code> to match various characters. For example, you can also match dashes, uppercase words, symbols, or specific strings.</p>

<pre><code>$config['routing']['search'] = [
  '!/default-test/([\w-]+)-route!', // 1
  '!/angry/path!'                   // 2
];
$config['routing']['replace'] = [
  '/default/route/${1}',            // 1
  '/default/route/angry/path'       // 2
];</code></pre>

<p>These examples:</p>
<ul>
  <li>Rewrite <code>/default-test/abc-123-route</code> into <code>/default/route/abc-123</code></li>
  <li>Rewrite <code>/angry/path</code> into <code>/default/route/angry/path</code></li>
</ul>

<p>Keep in mind that the resulting rewritten URL must point to a valid controller and method in your application.</p>
