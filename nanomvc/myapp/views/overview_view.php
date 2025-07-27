<h1>Overview</h1>

<p>
Welcome to the <strong>NanoMVC</strong> documentation overview. This section explains the basic structure of the framework, what each folder does, and where to place your files when building an application.
</p>

<h2>File Structure</h2>
<p>When you download NanoMVC, the package includes the following directory layout:</p>

<pre><code>/htdocs/
  index.php

/nanomvc/
  /myapp/
  /myfiles/
  /sysfiles/
</code></pre>

<h3>/htdocs/</h3>
<p>
This folder contains the public-facing entry point of your application. The <code>index.php</code> file located here should be placed inside your web server’s document root.
</p>

<h3>/nanomvc/</h3>
<p>
This is the core NanoMVC folder. For security reasons, it’s recommended to place this outside of the document root. It contains your application code, plugins, and system files.
</p>

<h3>/nanomvc/myapp/</h3>
<p>
This directory holds your actual application: controllers, models, views, and plugins. Most of your development will take place here.
</p>

<h3>/nanomvc/myfiles/</h3>
<p>
This folder is used in shared installations. If you run multiple NanoMVC-based projects, you can store common plugins here to share across them. Just move your plugin files from <code>/myapp/plugins/</code> into <code>/myfiles/plugins/</code>.
</p>

<h3>/nanomvc/sysfiles/</h3>
<p>
This directory contains the NanoMVC core system files. You typically won’t need to touch these. When updating NanoMVC to a newer version, only this directory should be replaced.
</p>

<p><a href="/doc/installation" class="btn-download">Continue to Installation &rarr;</a></p>
