<h1>Asset</h1>

<p>
The <code>Asset</code> plugin is a utility library for generating bundled JavaScript and CSS files from multiple source assets.
It allows you to define groups of files in a configuration file and combine them into a single asset for production while still using separate files during development.
</p>

<p>
The plugin is fully configuration-driven and does not require any build tools or external dependencies.
It integrates directly into NanoMVC and can generate bundled assets automatically when needed.
</p>

<h2>Configuration</h2>

<p>
Create a <code>config_generation.php</code> file and define your asset groups:
</p>

<pre><code>return [
  'templ' => [
    'css-top' => [
      'name' => 'app.css'
     ,'list' => [
        'style.css'
      ]
     ,'mode' => 'always'
    ]
   ,'js-top' => [
      'name' => 'app.js'
     ,'list' => [
        'script.js'
      ]
    ]
  ]
];</code></pre>

<p>
Each asset group supports these fields:
</p>

<ul>
  <li><code>name</code> – Required. Name of the generated bundled file.</li>
  <li><code>list</code> – Required. List of source files that will be merged.</li>
  <li><code>mode</code> – Optional. Overrides the generation mode for this group.</li>
</ul>

<p>
When generating a bundle, an absolute source file path is used as-is.
Unix-style and Windows-style absolute paths are recognized; the path must be valid on the host system.
Otherwise, the file is resolved relative to the configured source directory.
</p>

<h2>Loading the Library</h2>

<p>
Before loading Asset, the controller must expose the source directory, target directory, and generation mode.
For example:
</p>

<pre><code>class Page_Controller extends NanoMVC_Controller {
  public string $mode_tpl_from = &#8203;'/var/www/site/template';
  public string $mode_tpl_to = &#8203;'/var/www/site/generate';
  public string $mode_tpl_generation = 'yes';
  public NanoMVC_Library_Asset $asset;

  public function index(): void {
    $this->load->library(&#8203;'Asset', 'asset');
    $files = $this->asset->get(&#8203;'templ', 'css-top');
  }
}</code></pre>

<p>
Choose paths appropriate for your application. With this example, relative CSS source files in the
<code>templ</code> group are read from <code>/var/www/site/&#8203;template/templ/css/</code>.
</p>

<h2>Generating an Asset</h2>

<pre><code>$files = $this->asset->get(&#8203;'templ', 'css-top');</code></pre>

<p>
Depending on the configured generation mode, this method returns either:
</p>

<ul>
  <li>The original list of source file names.</li>
  <li>An array containing the generated bundle's filename.</li>
</ul>

<p>
This allows the application to use individual files while developing and automatically switch to bundled assets in production.
</p>

<h2>Generation Modes</h2>

<p>
The plugin supports three generation modes:
</p>

<ul>
  <li><code>no</code> – Never generate bundled assets. Always return the original source file list.</li>
  <li><code>yes</code> – Generate the bundled asset only if it does not already exist.</li>
  <li><code>always</code> – Regenerate the bundled asset on every <code>get()</code> call.</li>
</ul>

<p>
If <code>mode</code> is omitted, the group uses the controller's <code>mode_tpl_&#8203;generation</code> value.
With the examples above, <code>css-top</code> is rebuilt every time, while <code>js-top</code> is built only if <code>app.js</code> does not exist.
</p>

<p>
In <code>no</code> mode, the configured source list is returned unchanged and source files are not read.
The application is responsible for constructing URLs for the returned names.
If source files and bundles have different URL prefixes, use <code>get_mode()</code> to choose the prefix for each group.
</p>

<h2>Generated File Structure</h2>

<p>
Assets are generated into a separate output directory while preserving template and asset type directories.
For example:
</p>

<pre><code>generate/
└── templ/
    ├── css/
    │   └── app.css
    └── js/
        └── app.js</code></pre>

<h2>Generated Output</h2>

<p>
Each generated asset contains the contents of every configured source file.
A comment is inserted before each file to preserve file boundaries:
</p>

<pre><code>/* File: style.css */

...

/* File: layout.css */

...</code></pre>

<p>
This makes generated assets easier to inspect and debug.
</p>

<h2>Directory Resolution</h2>

<p>
By default, the output directory is determined from the generated file extension:
</p>

<ul>
  <li><code>app.css</code> → <code>css/</code></li>
  <li><code>app.js</code> → <code>js/</code></li>
</ul>

<p>
This behavior is implemented by the protected <code>get_folder()</code> method and can be overridden in inherited libraries to support custom directory layouts.
</p>

<h2>Available Methods</h2>

<h3><code>get(string $template, string $key): array</code></h3>

<p>
Returns the appropriate asset list according to the current generation mode.
If generation is enabled, the bundled asset is created automatically when required.
</p>

<ul>
  <li><code>$template</code> – Template name from the configuration.</li>
  <li><code>$key</code> – Asset group name.</li>
</ul>

<h3><code>get_mode(&#8203;string $template, &#8203;string $key): string</code></h3>

<pre><code>$mode = $this->asset->get_mode(&#8203;'templ', 'css-top');</code></pre>

<p>
Returns the effective mode (<code>no</code>, <code>yes</code>, or <code>always</code>) for the specified template and asset group.
It uses the loaded configuration without generating a bundle or reading source files.
</p>

<h2>Validation</h2>

<ul>
  <li>The requested template must exist.</li>
  <li>The requested asset group must exist.</li>
  <li>Every asset group must define both <code>name</code> and <code>list</code>.</li>
  <li>When a bundle is generated, all source files must exist and be readable.</li>
  <li>When a bundle is generated, the output directory must be writable.</li>
  <li>Unknown generation modes result in an exception.</li>
</ul>
