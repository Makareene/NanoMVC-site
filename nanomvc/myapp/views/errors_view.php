<h1>ErrorHandler</h1>

<h2>Custom Error Handler</h2>

<p>
NanoMVC allows you to define your own custom error handler class to handle system-level errors such as exceptions and warnings.
This gives you the flexibility to log, display, or process errors in a way that fits your application.
</p>

<h3>Learning by Example</h3>

<ol>
  <li>
    <strong>Create a new plugin file</strong><br>
    Add a new file to:<br>
    <code>/myapp/plugins/my_errorhandler.php</code>
  </li>
  <li>
    <strong>Extend the built-in error handler</strong><br>
    In your new file, define your class by extending <code>NanoMVC_ErrorHandler</code>:<br>
    <pre><code>class My_ErrorHandler extends NanoMVC_ErrorHandler {
  // put your logic here
}</code></pre>
  </li>
  <li>
    <strong>Update application config</strong><br>
    Open:<br>
    <code>/myapp/configs/config_application.php</code><br>
    and specify your custom handler:
    <pre><code>// PHP class that handles system errors
    $config['error_handler_class'] = 'My_ErrorHandler';</code></pre>
  </li>
</ol>

<p><strong>Result:</strong> Your custom error handler <code>My_ErrorHandler</code> will be automatically loaded and used on each request. All error and exception handling will pass through your overridden methods.</p>

<p>
You can override only what you need — such as logging logic — and leave the rest to the base class. This allows you to extend behavior without rewriting it from scratch.
</p>

<p><a href="/doc/templates" class="btn-download">&larr; Return to Integrating a Template Engine</a> <a href="/doc/customcore" class="btn-download">Continue to Customize Core &rarr;</a></p>
