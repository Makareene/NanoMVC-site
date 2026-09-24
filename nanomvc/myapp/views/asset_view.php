<h1>Asset</h1>

<p>
The <code>Asset</code> plugin is a utility library for generating bundled JavaScript and CSS files from multiple source assets.
It allows you to define groups of files in a configuration file and automatically produce a single optimized asset for production while still using separate files during development.
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
Each asset group contains two required fields:
</p>

<ul>
  <li><code>name</code> – Name of the generated bundled file.</li>
  <li><code>list</code> – List of source files that will be merged.</li>
</ul>

<p>
A source file that begins with the directory separator is treated as an absolute path.
Otherwise, the file is resolved relative to the configured source directory.
</p>

<h2>Loading the Library</h2>

<pre><code>$this->load->library('Asset', 'asset');</code></pre>

<h2>Generating an Asset</h2>

<pre><code>$files = $this->asset->get(&#8203;'templ', 'css-top');</code></pre>

<p>
Depending on the configured generation mode, this method returns either:
</p>

<ul>
  <li>The original list of source files.</li>
  <li>The generated bundled file.</li>
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
  <li><code>always</code> – Regenerate the bundled asset on every request.</li>
</ul>

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

<h2>Validation</h2>

<ul>
  <li>The requested template must exist.</li>
  <li>The requested asset group must exist.</li>
  <li>Every asset group must define both <code>name</code> and <code>list</code>.</li>
  <li>All source files must exist and be readable.</li>
  <li>The output directory must be writable.</li>
  <li>Unknown generation modes result in an exception.</li>
</ul>
