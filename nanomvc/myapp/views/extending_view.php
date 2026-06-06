<h1>Extending NanoMVC Classes</h1>

<h2>Custom Controller, Model, or View</h2>

<p>
NanoMVC allows you to extend core classes such as
<code>NanoMVC_Controller</code>,
<code>NanoMVC_Model</code>,
and <code>NanoMVC_View</code>
to add your own shared functionality.
</p>

<h2>Extending NanoMVC_Controller</h2>

<p>
Create your custom controller base class inside the
<code>/myapp/plugins/</code> directory:
</p>

<pre><code>// File: /myapp/plugins/my_controller.php

class My_Controller extends NanoMVC_Controller {

  // Add your common controller logic here

}</code></pre>

<p>
You may then extend your custom controller instead of
<code>NanoMVC_Controller</code>:
</p>

<pre><code>// File: /myapp/controllers/hello.php

class Hello_Controller extends My_Controller {

  public function index(): void {
    $this->view->display('hello');
  }

}</code></pre>

<p>
This approach is useful for authentication, common helper methods,
shared view preparation, and other functionality that should be available
to multiple controllers.
</p>

<p>
You do not need to manually include your custom base class.
NanoMVC automatically locates classes placed in the
<code>plugins</code> directory when needed.
</p>

<h2>Extending NanoMVC_Model</h2>

<p>
The same approach can be used for models:
</p>

<pre><code>// File: /myapp/plugins/my_model.php

class My_Model extends NanoMVC_Model {

  // Shared model functionality

}</code></pre>

<p>
Individual models may then extend <code>My_Model</code> instead of
<code>NanoMVC_Model</code>.
</p>

<h2>Extending NanoMVC_View</h2>

<p>
Views can also be extended:
</p>

<pre><code>// File: /myapp/plugins/my_view.php

class My_View extends NanoMVC_View {

  // Custom view functionality

}</code></pre>

<p>
Custom view classes are useful when you need additional rendering helpers,
custom template integration, or project-specific view behavior.
</p>

<p>
You are not limited to these classes. Any NanoMVC class may be extended
to add project-specific functionality while keeping your application code
clean and reusable.
</p>
