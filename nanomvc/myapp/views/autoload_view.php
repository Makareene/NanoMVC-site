<h1>Autoloading</h1>

<p>
NanoMVC automatically loads its own system files and plugin files from the configured NanoMVC plugin paths.
In most cases, you do not need to autoload NanoMVC libraries, controllers, models, or views manually.
</p>

<p>
The <code>autoload</code> option is intended for external PHP files that are not part of NanoMVC itself.
This is useful when you want to use an independent third-party project, a standalone library, or your own shared code stored outside the NanoMVC application structure.
</p>

<h2>Configuration</h2>

<p>
Autoloading is configured in:
</p>

<pre><code>/myapp/configs/config_application.php</code></pre>

<p>
Use the <code>autoload</code> option:
</p>

<pre><code>return [

  // Autoload files
 ,'autoload' => []

];</code></pre>

<h2>Autoloading External Files</h2>

<p>
If the path starts with <code>DS</code>, NanoMVC treats it as a full path.
This is useful for external projects located outside your NanoMVC application.
</p>

<pre><code>return [

  // Autoload files
 ,'autoload' => [
    DS . 'var' . DS . 'www' . DS . 'external' . DS . 'SomeProject' . DS . 'src' . DS . 'SomeClass.php'
  ]

];</code></pre>

<p>
NanoMVC will include this file during startup using <code>include_once</code>.
After that, the class defined in the external file can be used by your NanoMVC code.
</p>

<h2>Example: Wrapping an External Project</h2>

<p>
Suppose you cloned an independent project from Git:
</p>

<pre><code>/var/www/external/SomeProject/
  /src/
    SomeOriginalClass.php</code></pre>

<p>
You want to keep this project independent, so it can still receive updates from its original repository.
At the same time, you want to use it inside NanoMVC.
</p>

<p>
First, autoload the external class:
</p>

<pre><code>return [

  // Autoload files
 ,'autoload' => [
    DS . 'var' . DS . 'www' . DS . 'external' . DS . 'SomeProject' . DS . 'src' . DS . 'SomeOriginalClass.php'
  ]

];</code></pre>

<p>
Then create a NanoMVC library wrapper inside your plugins folder:
</p>

<pre><code>// File: /myapp/plugins/nanomvc_&#8203;library_someproject.php

class NanoMVC_Library_SomeProject extends SomeOriginalClass {

  // Add NanoMVC-specific wrapper logic here

}</code></pre>

<p>
Now you can use this wrapper as a regular NanoMVC library:
</p>

<pre><code>class Hello_Controller extends NanoMVC_Controller {

  public NanoMVC_Library_SomeProject $someproject;

  public function index(): void {
    $this->load->library('SomeProject', 'someproject');

    // Use methods inherited from SomeOriginalClass
    $result = $this->someproject->someMethod();

    $this->view->display(&#8203;'hello', ['result' => $result]);
  }

}</code></pre>

<p>
This keeps the external project separate from NanoMVC while still allowing you to integrate it cleanly through a NanoMVC library.
</p>

<h2>Relative Paths</h2>

<p>
If the path does not start with <code>DS</code>, NanoMVC treats it as a path relative to your <code>myapp</code> directory.
</p>

<pre><code>return [

  // Autoload files
 ,'autoload' => [
    'external/some_file.php'
  ]

];</code></pre>

<p>
This example resolves to:
</p>

<pre><code>/myapp/external/some_file.php</code></pre>

<h2>Important Notes</h2>

<ul>
  <li>NanoMVC plugin files are already handled by the framework autoloader.</li>
  <li>The <code>autoload</code> option is mainly for external or standalone PHP files.</li>
  <li>Autoloaded files are included with <code>include_once</code>.</li>
  <li>If an autoload file is missing, NanoMVC will throw an exception.</li>
  <li>Autoloading provides a centralized place to manage external dependencies and shared PHP files. Changing the file location later requires updating only the NanoMVC configuration.</li>
</ul>
