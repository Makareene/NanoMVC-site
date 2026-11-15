<h1>Customize Core</h1>

<p>
NanoMVC separates the framework entry class from the main core implementation.
This allows you to customize framework behavior without modifying the actual core logic.
</p>

<h2>Architecture</h2>

<p>
The file:
</p>

<pre><code>/sysfiles/NanoMVC.php</code></pre>

<p>
contains the public NanoMVC class:
</p>

<pre><code>class nmvc extends nmvc_core {}</code></pre>

<p>
The framework implementation is the abstract class <code>nmvc_core</code>, located in:
</p>

<pre><code>/sysfiles/NanoMVCCore.php</code></pre>

<p>
The application entry point (<code>htdocs/index.php</code>) loads <code>NanoMVCCore.php</code> first, then <code>NanoMVC.php</code>.
It creates an instance with <code>new nmvc()</code> and calls <code>main()</code>.
If your existing entry point only loads <code>NanoMVC.php</code>, add the core <code>require</code> before it.
</p>

<h2>Customizing NanoMVC</h2>

<p>
Copy <code>sysfiles/&#8203;NanoMVC.php</code> to <code>myapp</code>, <code>myfiles</code>, or any other location.
Edit the copy and replace the second <code>require</code> in <code>htdocs/index.php</code> with the path to your file.
For example, if you put the copy directly in <code>myapp</code>:
</p>

<pre><code>require NMVC_BASEDIR . 'sysfiles' . DS
  . 'NanoMVCCore.php';
require NMVC_MYAPPDIR . 'NanoMVC.php';

$nmvc = new nmvc();
$nmvc-&gt;main();</code></pre>

<p>
Your custom class must still be named <code>nmvc</code>.
Load your copy in place of the standard file so that <code>nmvc</code> is defined only once:
</p>

<pre><code>class nmvc extends nmvc_core {

  public function myMethod(): void {
    // Custom logic
  }

}</code></pre>

<p>
You may also override existing methods inherited from
<code>nmvc_core</code>.
</p>

<h2>Why This Exists</h2>

<p>
The separation between <code>nmvc</code> and <code>nmvc_core</code>
allows framework customization without modifying the core implementation.
</p>

<p>
The standard <code>sysfiles/&#8203;NanoMVC.php</code> remains part of the framework and may change during updates.
Keep your customizations in your own copy.
</p>

<p>
This makes upgrading NanoMVC easier because your changes are isolated
from the main framework code.
</p>

<h2>When to Use It</h2>

<p>
Most applications never need to customize the NanoMVC core.
Controllers, models, libraries, and plugins are usually sufficient.
</p>

<p>
Core customization is intended for framework-level changes that affect
the behavior of the NanoMVC application itself.
</p>
