<h1>Libraries</h1>

<h2>What is a library?</h2>

<p>
Libraries are reusable PHP classes used to extend the functionality of NanoMVC.
They are loaded through the NanoMVC loader and are typically used from controllers.
</p>

<p>
Libraries are stored in the <code>/myapp/plugins/</code> directory.
</p>

<h2>Loading a Library</h2>

<p>Let’s create a sample library plugin named <code>demo</code>:</p>

<pre><code>/myapp/
/plugins/
nanomvc_library_demo.php</code></pre>

<p>
The filename must be lowercase and follow the pattern
<code>nanomvc_library_*.php</code>.
The class name must match the filename suffix and start with
<code>NanoMVC_Library_</code>.
</p>

<pre><code>class NanoMVC_Library_Demo {

  public function test(): string {
    return 'This is a test.';
  }

}</code></pre>

<p>To use this library in a controller:</p>

<pre><code>class Hello_Controller extends NanoMVC_Controller {

  public NanoMVC_Library_Demo $mydemo;

  public function index(): void {
    $this->load->library('Demo', 'mydemo');

    $this->view->assign('output', $this->mydemo->test());
    $this->view->display(&#8203;'hello');
  }

}</code></pre>

<p>
Before loading a library, declare the target property in your controller.
NanoMVC validates that the property exists before assigning the library instance.
</p>

<p>
The second argument to <code>load-&gt;library()</code> is an alias for the library instance.
If not provided, the original name is used.
</p>

<p>
You now have a variable <code>$output</code> in your view with the result of the
<code>test()</code> method.
</p>
