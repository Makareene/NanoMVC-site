<h2>Customize Core</h2>

<p>
If you want to customize the core of NanoMVC, you should copy
<code>sysfiles/NanoMVC.php</code> to <code>myfiles/NanoMVC.php</code>. (You can also place it in the <code>myapp</code> folder if you prefer.)
Then, replace the following line in <code>myfiles/NanoMVC.php</code>:
</p>

<pre><code>require_once dirname(__FILE__) . DS . 'NanoMVCCore.php'; // main core class</code></pre>

<p>with this line:</p>

<pre><code>require_once dirname(__FILE__) . DS . '..' . DS . 'sysfiles' . DS . 'NanoMVCCore.php'; // main core class</code></pre>

<p>
And in your <code>index.php</code> file, replace:
</p>

<pre><code>// Load the core NanoMVC system
require NMVC_BASEDIR . 'sysfiles' . DS . 'NanoMVC.php';</code></pre>

<p>with:</p>

<pre><code>// Load the core NanoMVC system
require NMVC_BASEDIR . 'myfiles' . DS . 'NanoMVC.php';</code></pre>

<p>
With these changes, you will be able to customize everything you want using PHP capabilities like method overriding and more.
You will still be able to receive NanoMVC updates, because all core logic is handled in <code>NanoMVCCore.php</code>,
which is not affected by your custom <code>NanoMVC.php</code>.
</p>

<p><a href="/doc/errors" class="btn-download">&larr; Return to Custom Error Handler</a></p>
