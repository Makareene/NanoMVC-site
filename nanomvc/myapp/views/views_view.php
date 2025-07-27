<h1>Views</h1>

<h2>What is a view?</h2>
<p>View files contain the final presentation elements of your content, such as HTML markup and styling. They are responsible for how your application appears to the user.</p>

<h2>Learning by example</h2>
<p>View files are stored in the <code>/myapp/views/</code> directory. Here's a basic structure:</p>
<pre><code>/myapp/
  /views/
    hello_view.php</code></pre>

<p>Although not mandatory, it's recommended to append <code>_view</code> to view filenames to distinguish them from other files.</p>

<p><strong>hello_view.php</strong></p>
<pre><code>&lt;html&gt;
  &lt;head&gt;&lt;title&gt;Hello&lt;/title&gt;&lt;/head&gt;
  &lt;body&gt;
    Hello World.
  &lt;/body&gt;
&lt;/html&gt;</code></pre>

<p>To load this view from a controller:</p>
<pre><code>class Hello_Controller extends NanoMVC_Controller {
  function index() {
    $this->view->display('hello_view');
  }
}</code></pre>

<p>Note: always omit the <code>.php</code> extension when specifying the view name.</p>

<p>Loading <code>http://localhost/index.php/hello</code> will display:</p>
<pre><code>&lt;html&gt;
  &lt;head&gt;&lt;title&gt;Hello&lt;/title&gt;&lt;/head&gt;
  &lt;body&gt;
    Hello World.
  &lt;/body&gt;
&lt;/html&gt;</code></pre>

<h2>Capture view output to a variable</h2>
<p>If you want to capture the view output instead of displaying it directly, use <code>$this->view->fetch()</code>:</p>
<pre><code>class Hello_Controller extends NanoMVC_Controller {
  function index() {
    $output = $this->view->fetch('hello_view');
  }
}</code></pre>

<h2>Assigning variables to the view</h2>
<p>To pass data to your views, use <code>assign()</code>. Here's how:</p>
<pre><code>class Hello_Controller extends NanoMVC_Controller {
  function index() {
    $this->view->assign('title', 'Hello');
    $this->view->assign('body_text', 'Hello World.');
    $this->view->display('hello_view');
  }
}</code></pre>

<p><strong>hello_view.php</strong></p>
<pre><code>&lt;html&gt;
  &lt;head&gt;&lt;title&gt;&lt;?=$title?&gt;&lt;/title&gt;&lt;/head&gt;
  &lt;body&gt;
    &lt;?=$body_text?&gt;
  &lt;/body&gt;
&lt;/html&gt;</code></pre>

<p>This outputs the same result, but with content injected from the controller:</p>
<pre><code>&lt;html&gt;
  &lt;head&gt;&lt;title&gt;Hello&lt;/title&gt;&lt;/head&gt;
  &lt;body&gt;
    Hello World.
  &lt;/body&gt;
&lt;/html&gt;</code></pre>

<p>You can also assign data using an array:</p>
<pre><code>$data['title'] = 'Hello';
$data['body_text'] = 'Hello world.';
$this->view->assign($data);</code></pre>

<p>All variables assigned with <code>assign()</code> are internally stored in <code>$this->view->view_vars</code> and extracted for use in all views.</p>

<p>If you want variables to apply only to a specific view, pass them as a second parameter to <code>display()</code>:</p>
<pre><code>$data['title'] = 'Hello';
$data['body_text'] = 'Hello world.';
$this->view->display('hello_view', $data);</code></pre>

<p><strong>Note:</strong> This example uses static text for simplicity. In real applications, content should come from models, config files, or libraries. Avoid embedding content directly in controllers or models to maintain proper MVC architecture.</p>

<p><a href="/doc/controllers" class="btn-download">&larr; Return to Controllers</a> <a href="/doc/models" class="btn-download">Continue to Models &rarr;</a></p>
