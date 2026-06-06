<h1>Overview</h1>

<p>
Welcome to the <strong>NanoMVC</strong> documentation overview. This section explains the basic structure of the framework, what each folder does, and where to place your files when building an application.
</p>

<h2>File Structure</h2>

<p>
When you download NanoMVC, the package includes the following directory layout:
</p>

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
This is the core NanoMVC folder. For security reasons, it is recommended to place this directory outside of the document root. It contains your application code, shared files, and system files.
</p>

<h3>/nanomvc/myapp/</h3>

<p>
This directory contains your application files: controllers, models, views, libraries, configuration files, and other project-specific code. Most of your development will take place here.
</p>

<h3>/nanomvc/myfiles/</h3>

<p>
This folder is used for shared installations. If you run multiple NanoMVC-based projects, you can place common libraries, models, views, configuration files, and other reusable files here.
</p>

<p>
Files in <code>/myapp/</code> are application-specific, while files in <code>/myfiles/</code> can be shared between several NanoMVC applications.
</p>

<h3>/nanomvc/sysfiles/</h3>

<p>
This directory contains the NanoMVC core system files. You usually should not edit these files directly. When updating NanoMVC to a newer version, this is the main directory that can be replaced.
</p>
