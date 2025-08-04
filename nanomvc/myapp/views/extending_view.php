<h1>Extending</h1>

<h2>Custom Controller, Model, or View</h2>
<p>NanoMVC allows you to easily extend core classes like <code>NanoMVC_Controller</code>, <code>NanoMVC_Model</code>, or <code>NanoMVC_View</code> to add your own logic and base functionality.</p>

<h3>Extending NanoMVC_Controller</h3>
<p>Create your custom controller base class inside the <code>/myapp/plugins/</code> directory:</p>

<pre><code>// File: /myapp/plugins/my_controller.php

class My_Controller extends NanoMVC_Controller {
  // Add your common controller logic here
}</code></pre>

<p>Now in your controllers, extend <code>My_Controller</code> instead of <code>NanoMVC_Controller</code>:</p>

<pre><code>// File: /myapp/controllers/hello.php

class Hello_Controller extends My_Controller {
  function index() {
    $this->view->display('hello_view');
  }
}</code></pre>

<p><strong>Note:</strong> You do not need to manually include your custom base class. NanoMVC will autoload it automatically if it is placed in the <code>plugins</code> directory and named as <code>classname.php</code>.</p>

<h3>Extending NanoMVC_Model or NanoMVC_View</h3>
<p>The same process works for <code>NanoMVC_Model</code> and <code>NanoMVC_View</code>:</p>

<ul>
  <li><code>/myapp/plugins/my_model.php</code> — class <code>My_Model extends NanoMVC_Model</code></li>
  <li><code>/myapp/plugins/my_view.php</code> — class <code>My_View extends NanoMVC_View</code></li>
</ul>

<p>You can then use your extended versions in your application wherever needed.</p>
