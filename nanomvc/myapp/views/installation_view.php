<h1>Installation</h1>

<p>
Welcome to the <strong>NanoMVC</strong> installation guide. This section walks you through setting up the framework, configuring paths, and preparing your environment to start building applications.
</p>

<h2>Quick Start</h2>

<p>
To get started quickly:
</p>

<ul>
  <li>Download or clone NanoMVC</li>
  <li>Place <code>htdocs/index.php</code> in your web document root</li>
  <li>Open your site in a browser</li>
  <li>You should see the NanoMVC welcome page</li>
</ul>

<h2>Single Installation (Typical)</h2>
<p>
This setup is intended for a single website. If you’re planning to host multiple websites that share the NanoMVC core, see the "<b>Shared Installation</b>" section below.
</p>

<h3>Directory Structure</h3>
<p>After unpacking the archive, you’ll see something like this:</p>
<pre><code>/htdocs/
  index.php

/nanomvc/
  /myapp/
  /myfiles/
  /sysfiles/
</code></pre>

<h3>Setup</h3>
<ol>
  <li>Move <code>index.php</code> into your web server document root</li>
  <li>Move the entire <code>/nanomvc/</code> directory outside the web root (recommended)</li>
  <li>If keeping it inside the web root, configure your web server to deny access to it</li>
</ol>

<h4>Example Layout</h4>
<pre><code>/var/www.foo.bar/htdocs/
  index.php

/var/www.foo.bar/nanomvc/
  /myapp/
  /myfiles/
  /sysfiles/
</code></pre>

<h3>Configuration</h3>
<p>Edit <code>index.php</code> and set paths as needed:</p>
<pre><code>// Enable full error reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Directory separator constant
if (!defined('DS')) define('DS', DIRECTORY_SEPARATOR);
// Uncomment and set if the /nanomvc/ dir is not one level above this file
// define('NMVC_BASEDIR', __DIR__ . DS . '..' . DS . 'nanomvc' . DS);
</code></pre>

<ul>
  <li>Change <code>error_reporting(E_ALL);</code> to <code>error_reporting(0);</code> and <code>ini_set('display_errors', '1');</code> to <code>ini_set('display_errors', '0');</code> to hide all errors (typically for a production environment).</li>
  <li>Set the correct <code>NMVC_BASEDIR</code> path if necessary</li>
  <li>Always include a trailing slash (<code>DS</code>)</li>
</ul>

<p>
If you define <code>NMVC_ERROR_HANDLING</code> and set it to <code>1</code>, NanoMVC will use its internal error and exception handlers. If you omit this or set it to <code>0</code>, PHP's default handlers will be used instead. This is useful for debugging during development.
</p>

<p>
After saving, open <code>http://localhost/</code> in your browser. If you don’t see the welcome screen, recheck your paths and error messages.
</p>

<h2>Database Settings</h2>
<p>If your application uses a database, edit:</p>
<pre><code>/nanomvc/myapp/configs/&#8203;config_database.php</code></pre>

<p>
Configuration files in NanoMVC return arrays. The database configuration file contains one or more named connection definitions.
</p>

<p>Example configuration:</p>
<pre><code>return [
  'default_pool' => 'default'
 ,'default' => [
    'plugin'     => 'NanoMVC_PDO' // Plugin for DB access
   ,'type'       => 'mysql'       // Connection type
   ,'host'       => 'localhost'   // DB hostname
   ,'name'       => 'dbname'      // DB name
   ,'user'       => 'dbuser'      // DB username
   ,'pass'       => 'dbpass'      // DB password
   ,'persistent' => false         // DB connection persistence?
  ]
];
</code></pre>

<ul>
  <li><code>default_pool</code> specifies which connection will be used by default</li>
  <li><code>default</code> is the name of the database connection pool</li>
  <li>You can define multiple pools by adding additional connection definitions</li>
  <li>Use <code>NanoMVC_PDO</code> unless you have your own database plugin</li>
</ul>

<h2>Shared Installation</h2>
<p>
This setup allows multiple websites to share the NanoMVC core files and common resources.
</p>

<h3>Structure</h3>
<pre><code># Shared code
/usr/local/lib/nanomvc/
  /myfiles/
  /sysfiles/

# Website 1
/var/www.foo1.bar/htdocs/index.php
/var/www.foo1.bar/myapp/

# Website 2
/var/www.foo2.bar/htdocs/index.php
/var/www.foo2.bar/myapp/

# Website 3
/var/www.foo3.bar/htdocs/index.php
/var/www.foo3.bar/myapp/
</code></pre>

<p>For each website:</p>
<ol>
  <li>Install a unique <code>index.php</code> under its document root</li>
  <li>Copy <code>/myapp/</code> to the corresponding site folder</li>
  <li>Edit <code>index.php</code> and define the paths:</li>
</ol>

<pre><code>/* NanoMVC base library path */
define('NMVC_BASEDIR', '/usr/local/lib/nanomvc/');

/* application library path */
define('NMVC_MYAPPDIR', '../myapp/');
</code></pre>

<ul>
  <li>Be sure to include a trailing slash for both paths</li>
  <li><code>/sysfiles/</code> should never be modified directly — it’s updated on NanoMVC upgrades</li>
  <li>Use <code>/myfiles/</code> to store shared libraries, models, views, configuration files, and other reusable resources across projects.</li>
</ul>

<h2>Using Git for Updates</h2>

<p>
If you use Git to get updates — which is a good idea compared to updating manually — keep the following in mind:
</p>

<ul>
  <li>
  The <code>nanomvc/myapp</code> folder can be modified. It contains demo materials to showcase how NanoMVC works.
  Any changes you make there may lead to conflicts during updates. The best practice is to copy this folder elsewhere.
  Instructions for where to copy it are provided earlier in this chapter.
  </li>
  <li>
  You are free to modify anything under <code>nanomvc/myfiles</code>.
  This directory is intended for shared application resources and is not normally modified by NanoMVC updates.
  </li>
</ul>
