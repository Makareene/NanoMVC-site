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
Application rendering uses <code>display()</code>, while framework system views use <code>sysview()</code>.
Both call the protected <code>_display()</code> method, so a custom implementation can override the entry points separately or change their shared behavior.
Note that <code>fetch()</code> calls <code>display()</code>.
</p>

<p>
Since NanoMVC 1.1.0, <code>_view()</code> receives the view name as its first argument rather than the resolved file path.
The current path is held in the protected <code>$filepath</code> property and restored after nested rendering.
Update any custom <code>_view()</code> override that relies on the former argument.
</p>

<p>
The framework core, <code>nmvc_core</code>, is abstract. The application starts an instance of <code>nmvc</code>, which extends it.
The entry point loads <code>NanoMVCCore.php</code> before the file that defines <code>nmvc</code>.
</p>

<p>
To customize the core, copy <code>sysfiles/&#8203;NanoMVC.php</code> to <code>myapp</code>, <code>myfiles</code>, or any other location.
In <code>htdocs/index.php</code>, change the second <code>require</code> to load your copy.
Keep the class name <code>nmvc</code> and leave <code>new nmvc()</code> unchanged.
See <a href="/doc/customcore">Customize Core</a> for an example.
</p>

<p>
You are not limited to these classes. Any NanoMVC class may be extended
to add project-specific functionality while keeping your application code
clean and reusable.
</p>
