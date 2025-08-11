<h1>Custom Error Handler</h1>

<p>
NanoMVC allows you to define your own custom error handler class to handle system-level errors such as exceptions and warnings.
This gives you the flexibility to log, display, or process errors in a way that fits your application.
</p>

<h3>Learning by Example</h3>

<ol>
  <li>
    <strong>Create a new plugin file</strong><br>
    Add a new file to:<br>
    <code>/myapp/plugins/&#8203;my_errorhandler.php</code>
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
    <code>/myapp/configs/config_&#8203;application.php</code><br>
    and specify your custom handler:
    <pre><code>// PHP class that handles system errors
$config['error_handler_class'] = 'My_ErrorHandler';</code></pre>
  </li>
</ol>

<p><strong>Result:</strong> Your custom error handler <code>My_ErrorHandler</code> will be automatically loaded and used on each request. All error and exception handling will pass through your overridden methods.</p>

<p>
You can override only what you need — such as logging logic — and leave the rest to the base class. This allows you to extend behavior without rewriting it from scratch.
</p>

<h2>HTTP Error Codes and Views</h2>

<p>
NanoMVC automatically sends an appropriate HTTP status header when an error occurs.
If no specific code is provided, the framework defaults to sending a <strong>500 Internal Server Error</strong> header.
</p>

<p>
To trigger specific error views and headers (such as a 404 page), you can throw an exception with the desired code:
</p>

<pre><code>throw new Exception('Page not found', 404);</code></pre>

<p>
If the code is <code>404</code>, the view file <code>/sysfiles/views/notfound_view.php</code> will be used instead of the default <code>/sysfiles/views/error_view.php</code>.
You can customize both views by placing your own versions in <code>/myapp/views/</code> or <code>/myfiles/views/</code>. Your modified version will be used automatically in your project.
</p>

<p>
Supported HTTP codes:
</p>

<pre><code>400 => Bad Request
401 => Unauthorized
403 => Forbidden
404 => Not Found
405 => Method Not Allowed
408 => Request Timeout
410 => Gone
429 => Too Many Requests
500 => Internal Server Error
501 => Not Implemented
502 => Bad Gateway
503 => Service Unavailable
504 => Gateway Timeout</code></pre>
