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
The actual framework implementation is located in:
</p>

<pre><code>/sysfiles/NanoMVCCore.php</code></pre>

<p>
The application entry point (<code>htdocs/index.php</code>) loads
<code>NanoMVC.php</code>, which in turn loads
<code>NanoMVCCore.php</code>.
</p>

<h2>Customizing NanoMVC</h2>

<p>
To customize framework behavior, simply extend the <code>nmvc</code> class.
</p>

<p>
For example:
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
In most cases, NanoMVC updates only affect
<code>NanoMVCCore.php</code>,
while your customizations remain inside
<code>NanoMVC.php</code>.
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
