<h1>Custom Database Plugin</h1>

<p>
NanoMVC includes the built-in <code>NanoMVC_PDO</code> database plugin.
If you need additional functionality or different behavior, you can create your own database plugin by extending it.
</p>

<ol>
  <li>
    <strong>Create a new plugin file</strong><br>
    Create a new file in:<br>
    <code>/myapp/plugins/nanomvc_mydb.php</code><br>
    or<br>
    <code>/myfiles/plugins/&#8203;nanomvc_mydb.php</code>
  </li>

  <li>
    <strong>Extend the PDO plugin</strong><br>
    In your new file, define a class that extends <code>NanoMVC_PDO</code>:
    <pre><code>class NanoMVC_MYDB extends NanoMVC_PDO {

  // Override or extend methods here

}</code></pre>
  </li>

  <li>
    <strong>Modify the logic</strong><br>
    Add your own methods or override existing ones to customize database behavior.
  </li>

  <li>
    <strong>Update the database configuration</strong><br>
    Open:
    <br>
    <code>/myapp/configs/&#8203;config_database.php</code>
    <br>
    and set your plugin as the database driver:
    <pre><code>return [
  'default_pool' => 'default'
 ,'default' => [
    'plugin' => 'NanoMVC_MYDB'
  ]
];</code></pre>
  </li>
</ol>

<p>
You may use different plugins for different database pools if required.
</p>

<p>
<strong>Result:</strong> NanoMVC will automatically instantiate your custom database class instead of <code>NanoMVC_PDO</code>, while still allowing you to inherit and reuse the existing functionality.
</p>
