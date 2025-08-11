<h1>Custom Database Plugin</h1>

<p>If you want to use a custom database plugin instead of the built-in PDO-based one, follow these steps:</p>

<ol>
  <li>
    <strong>Create a new plugin file</strong><br>
    Create a new file in:<br>
    <code>/myapp/plugins/nanomvc_mydb.php</code> or <code>/myfiles/plugins/&#8203;nanomvc_mydb.php</code>
  </li>
  <li>
    <strong>Extend the PDO plugin</strong><br>
    In your new file, define your class by extending the built-in PDO class:<br>
    <pre><code>class NanoMVC_MYDB extends NanoMVC_PDO {
  // Override or extend methods here
}</code></pre>
  </li>
  <li>
    <strong>Modify the logic</strong><br>
    Adjust or extend the functionality to match your database system or preferences.
  </li>
  <li>
    <strong>Update the config</strong><br>
    Open your database configuration:<br>
    <code>/myapp/configs/&#8203;config_database.php</code><br>
    and change the plugin name:<br>
    <pre><code>$config['yourpool']['plugin'] = 'NanoMVC_MYDB';</code></pre>
  </li>
</ol>

<p><strong>Result:</strong> NanoMVC will now load your custom database class <code>NanoMVC_MYDB</code> automatically on each request, inheriting the base functionality of <code>NanoMVC_PDO</code>.</p>
