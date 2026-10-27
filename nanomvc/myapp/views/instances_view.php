<h1>Getting an Instance</h1>

<p>
There may be situations where you need to access NanoMVC outside the current controller.
For example, this can be useful inside libraries, custom plugins, or framework extensions.
</p>

<p>
You can retrieve the main NanoMVC instance using:
</p>

<pre><code>$nmvc = nmvc::instance();</code></pre>

<h2>Accessing the Current Controller</h2>

<p>
To access the currently active controller, use the controller-specific instance:
</p>

<pre><code>$controller = nmvc::instance(null, 'controller');</code></pre>

<p>
This is the preferred way to access the controller instance from outside the controller itself.
It also works correctly during controller construction.
</p>

<p>
For example:
</p>

<pre><code>$output = $controller->view->fetch(&#8203;'some', [
  'foo' => 'bar'
 ,'baz' => 'gaz'
]);</code></pre>

<h2>Accessing the View Object</h2>

<p>
The shared view object can also be accessed directly from the main NanoMVC instance:
</p>

<pre><code>$view = nmvc::instance()->getView();</code></pre>

<p>
For example:
</p>

<pre><code>$output = $view->fetch(&#8203;'some', [
  'foo' => 'bar'
 ,'baz' => 'gaz'
]);</code></pre>

<h2>URL Segments</h2>

<p>
To get parsed URL segments, use:
</p>

<pre><code>$segments = nmvc::instance()->getUrlSegments();</code></pre>

<p>
In most cases, it is more convenient to use the <code>URI</code> library from a controller.
</p>

<p>
To get the original <code>PATH_INFO</code> before NanoMVC routing:
</p>

<pre><code>$path = nmvc::instance()&#8203;->getOriginalPathInfo();</code></pre>

<p>
This preserves the path supplied by the web server; if <code>PATH_INFO</code> is absent or empty, it returns <code>/</code>.
For the library equivalent, see <a href="/doc/usefullibraries">Useful Libraries</a>.
</p>

<h2>Checking Absolute Paths</h2>

<p>
The main NanoMVC instance provides a cross-platform helper for checking whether a filesystem path is absolute:
</p>

<pre><code>$is_absolute = nmvc::instance()&#8203;->isAbsolutePath($path);</code></pre>

<p>
The method supports Unix-style paths, Windows drive paths, and paths beginning with a backslash.
</p>

<h2>Finding Framework Files</h2>

<p>
The main NanoMVC instance also exposes file discovery helpers.
These methods return the resolved file path or <code>false</code> if the file was not found.
</p>

<pre><code>$config_file     = nmvc::instance()->findConfig(&#8203;'application');
$controller_file = nmvc::instance()->findController(&#8203;'default');
$model_file      = nmvc::instance()->findModel(&#8203;'Page');
$view_file       = nmvc::instance()->findView(&#8203;'hello');</code></pre>

<p>
There are also plural methods that return arrays of matching files:
</p>

<pre><code>$configs     = nmvc::instance()->findConfigs();
$controllers = nmvc::instance()->findControllers();
$models      = nmvc::instance()->findModels();
$views       = nmvc::instance()->findViews();</code></pre>

<p>
View lookups accept nested names using <code>/</code>, and <code>findViews()</code> accepts glob patterns:
</p>

<pre><code>$view = nmvc::instance()&#8203;->findView(&#8203;'admin/reports/list');
$views = nmvc::instance()&#8203;->findViews(&#8203;'admin/*');</code></pre>

<p>
The default <code>findViews()</code> search covers only the root of each views directory; it does not search subdirectories recursively.
Search results are keyed by filename, so if multiple matches have the same filename, only the first match is returned.
Results that expand to a dot-slash path are skipped. See <a href="/doc/views">Views</a> for view path rules.
</p>

<p>
Config, controller, and model names or search patterns cannot contain <code>/</code> or <code>\</code>; these types do not support nested paths.
An invalid name or pattern causes an exception.
</p>

<h2>When to Use It</h2>

<p>
Most application code should use normal controller properties such as
<code>$this->view</code>, <code>$this->load</code>, and loaded libraries.
Direct access to the NanoMVC instance is mainly useful when writing reusable libraries,
custom plugins, or low-level framework extensions.
</p>
