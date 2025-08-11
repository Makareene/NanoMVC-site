<h1>Getting an Instance</h1>
<p>
There may be situations where you need to access the current application instance outside the controller — for example, inside a library, model, or plugin — in order to call controller methods or interact with views.
</p>

<p>
You can retrieve the instance at any time using:
</p>

<pre><code>$nmvc = nmvc::instance();</code></pre>

<p>
Once you have the instance, you can use it to work with views, configuration, and other controller-related functionality:
</p>

<pre><code>$myvars = [];
$myvars['foo'] = 'bar';
$myvars['baz'] = 'gaz';

$output = $nmvc->controller->view->fetch(&#8203;'some_view', $myvars);</code></pre>

<h2>Available Properties</h2>
<p>The <code>nmvc::instance()</code> object exposes several helpful properties:</p>

<ul>
  <li><code>$nmvc->controller</code> — the current controller object</li>
  <li><code>$nmvc->action</code> — the name of the controller method currently being executed</li>
  <li><code>$nmvc->url_segments</code> — an array of URL segments following the controller and action</li>
  <li><code>$nmvc->config</code> — the loaded application configuration array</li>
</ul>

<p>
These allow you to interact with the runtime context of the application, even when you're outside the main controller scope.
</p>
