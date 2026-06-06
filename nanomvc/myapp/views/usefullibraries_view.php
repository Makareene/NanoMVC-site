<h1>Useful Libraries</h1>

<p>
This article describes several utility libraries included with NanoMVC.
If you are unfamiliar with NanoMVC libraries or how to load them, please read the
<a href="/doc/libraries">Libraries</a> documentation first.
</p>

<h2><code>NanoMVC_Library_URI</code></h2>

<p>
Load the library:
</p>

<pre><code>class Hello_Controller extends NanoMVC_Controller {

  public NanoMVC_Library_URI $uri;

  public function index(): void {
    $this->load->library(&#8203;'URI', 'uri');
  }

}</code></pre>

<p>
This library provides tools for working with URL segments and query strings in NanoMVC.
</p>

<ul>
  <li>
    <strong>segment(int $index = 1): string|false</strong><br>
    Returns the N-th URI segment (starting from 1). Returns <code>false</code> if the segment does not exist.
  </li>

  <li>
    <strong>uri_to_assoc(int $index = 1): array</strong><br>
    Converts URI segments into an associative array starting from the specified index.
    Useful for parsing URLs such as:
    <pre><code>/key1/value1/key2/value2</code></pre>
  </li>

  <li>
    <strong>uri_to_array(int $index = 1): array</strong><br>
    Returns all URI segments as an indexed array starting from the specified position.
  </li>

  <li>
    <strong>uri(int $index = 1): string</strong><br>
    Returns the remaining URI path starting from the specified segment.
    <br>
    Example:
    <pre><code>// URI: /article/php/routing

$this->uri->uri(2);

// Result:
php/routing</code></pre>
  </li>

  <li>
    <strong>parse_query_string(string $query = ''): array</strong><br>
    Parses a query string into an array of <code>['key' =&gt; ..., 'val' =&gt; ...]</code> pairs.
    Empty keys and values are preserved.
    <br>
    Example:
    <pre><code>$result = $this->uri->parse_query_string(&#8203;'id=5&amp;sort=name');</code></pre>
    Result:
    <pre><code>[
  ['key' => 'id',   'val' => '5']
 ,['key' => 'sort', 'val' => 'name']
]</code></pre>
  </li>
</ul>

<h2><code>NanoMVC_Library&#8203;_Helper</code></h2>

<p>
Load the library:
</p>

<pre><code>class Hello_Controller extends NanoMVC_Controller {

  public NanoMVC_Library_Helper $dh;

  public function index(): void {
    $this->load->library(&#8203;'Helper', 'dh');
  }

}</code></pre>

<p>
A collection of helper methods commonly used in NanoMVC applications for debugging,
redirection, rendering views, sending headers, escaping output, URL normalization,
and validating data.
</p>

<ul>
  <li>
    <strong>debug(mixed $var, ?string $name = null, bool $return = false, bool $esc = true, bool $hide = false): ?string</strong><br>
    Displays a formatted debug window for the specified variable.
    Can optionally return the result instead of printing it, escape HTML output, or hide the output inside HTML comments.
  </li>

  <li>
    <strong>redirect(string $uri, ?int $code = null): false</strong><br>
    Sends a redirect to the specified URI.
    Supports HTTP status codes such as <code>301</code>.
  </li>

  <li>
    <strong>send_headers(array $headers = [], bool $replace = true): bool</strong><br>
    Sends raw or associative HTTP headers safely.
    HTTP status headers are detected automatically.
  </li>

  <li>
    <strong>esc_html(string $text): string</strong><br>
    Escapes HTML special characters using
    <code>ENT_QUOTES | ENT_SUBSTITUTE</code>.
    <br>
    Example:
    <pre><code>&lt;h1&gt;&lt;?=$this->dh->&#8203;esc_html($title)?&gt;&lt;/h1&gt;</code></pre>
  </li>

  <li>
    <strong>view(string $filename, ?array $vars = null): void</strong><br>
    Renders a view with optional variables.
    This method is useful when rendering a view from within another library or helper class.
    <br>
    Example:
    <pre><code>$this->view->display('page', ['dh' => $this->dh]);// inside a method first
$dh->view('pagination', $vars); // then inside the page view</code></pre>
  </li>

  <li>
    <strong>is_int_like(mixed $value): bool</strong><br>
    Checks whether a value is an integer or an integer-like string.
    <br>
    Examples:
    <pre><code>"42"   => true
-7     => true
"abc"  => false
"4.2"  => false</code></pre>
  </li>

  <li>
    <strong>public_path(string $path): string</strong><br>
    Normalizes a public URL path by removing empty path parts and path traversal fragments such as
    <code>.</code> and <code>..</code>.
    <br>
    Example:
    <pre><code>$this->dh->public_path(&#8203;'/asd//dsa///..&#8203;/../realconfig.html');

// Result:
/asd/dsa/realconfig.html</code></pre>
  </li>
</ul>
