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

<h2>When to Use It</h2>

<p>
Most application code should use normal controller properties such as
<code>$this->view</code>, <code>$this->load</code>, and loaded libraries.
Direct access to the NanoMVC instance is mainly useful when writing reusable libraries,
custom plugins, or low-level framework extensions.
</p>
