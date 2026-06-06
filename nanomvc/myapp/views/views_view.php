<h1>Views</h1>

<h2>What is a view?</h2>
<p>View files contain the final presentation elements of your content, such as HTML markup and styling. They are responsible for how your application appears to the user.</p>

<h2>Learning by example</h2>
<p>View files are stored in the <code>/myapp/views/</code> directory. Here's a basic structure:</p>
<pre><code>/myapp/
  /views/
    hello_view.php</code></pre>

<p><strong>hello_view.php</strong></p>
<pre><code>&lt;html&gt;
  &lt;head&gt;&lt;title&gt;Hello&lt;/title&gt;&lt;/head&gt;
  &lt;body&gt;
    Hello World.
  &lt;/body&gt;
&lt;/html&gt;</code></pre>

<p>To load this view from a controller:</p>
<pre><code>class Hello_Controller extends NanoMVC_Controller {

  public function index(): void {
    $this->view->display('hello');
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

<h2>Capturing View Output</h2>
<p>If you want to capture the view output instead of displaying it directly, use <code>$this->view->fetch()</code>:</p>
<pre><code>class Hello_Controller extends NanoMVC_Controller {

  public function index(): void {
    $output = $this->view->fetch('hello');
  }

}</code></pre>

<h2>Assigning variables to the view</h2>
<p>To pass data to your views, use <code>assign()</code>. Here's how:</p>
<pre><code>class Hello_Controller extends NanoMVC_Controller {

  public function index(): void {
    $this->view->assign(&#8203;'title', 'Hello');
    $this->view->assign(&#8203;'body_text', 'Hello World.');
    $this->view->display(&#8203;'hello');
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

<p>
All variables assigned with <code>assign()</code> are internally stored by the view object and extracted for use in all subsequently rendered views.
</p>

<p>If you want variables to apply only to a specific view, pass them as a second parameter to <code>display()</code>:</p>
<pre><code>$data['title'] = 'Hello';
$data['body_text'] = 'Hello world.';
$this->view->display(&#8203;'hello', $data);</code></pre>

<p>
Variables passed directly to <code>display()</code> or <code>fetch()</code> override variables previously assigned using <code>assign()</code>.
</p>

<p><strong>Note:</strong> This example uses static text for simplicity. In real applications, content should come from models, config files, or libraries. Avoid embedding content directly in controllers or models to maintain proper MVC architecture.</p>

<h2>View Discovery</h2>

<p>
NanoMVC automatically locates view files using its view discovery system.
When calling:
</p>

<pre><code>$this->view->display(&#8203;'hello');</code></pre>

<p>
NanoMVC searches the configured view locations and automatically resolves the correct file. Neither the <code>.php</code> extension nor the <code>_view</code> suffix should be specified when calling <code>display()</code> or <code>fetch()</code>.
</p>
