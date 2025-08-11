<h1>Useful Plugins</h1>

<h2><code>NanoMVC_Library_URI</code></h2>
<p>This plugin provides tools for working with URL segments in NanoMVC.</p>
<ul>
  <li>
    <strong>segment(int $index = 1): string|false</strong> — Returns the N-th URI segment (starting from 1). Returns <code>false</code> if it doesn’t exist.
  </li>

  <li>
    <strong>uri_to_assoc(int $index = 1): array</strong> — Converts URI segments into an associative array starting from the given index. Useful for parsing <code>/key1/value1/key2/value2</code>-style URLs.
  </li>

  <li>
    <strong>uri_to_array(int $index = 1): array|false</strong> — Returns all URI segments as an indexed array starting at the given position.
  </li>

  <li>
    <strong>uri(int $index = 1): ?string</strong> — Returns the remaining URI path from the given segment index as a string.
  </li>

  <li>
    <strong>parse_query_string(string $query = ''): array</strong> — Parses a query string into an array of <code>['key' => ..., 'val' => ...]</code> pairs. Empty keys or values are allowed and preserved.
  </li>
</ul>

<h2><code>NanoMVC_Script_Helper</code></h2>
<p>A utility plugin for debugging, redirection, sending headers, view rendering, and type checking.</p>
<ul>
  <li>
    <strong>debug(mixed $var, ?string $name = null, bool $return = false, bool $esc = true, bool $hide = false): ?string</strong><br>
    Displays a formatted debug window of the given variable. Can optionally return the result instead of printing it, escape HTML, or hide the output in HTML comments.
  </li>

  <li>
    <strong>redirect(string $uri, ?int $code = null): false</strong><br>
    Sends a redirect to the given URI, optionally with a status code (e.g. 301).
  </li>

  <li>
    <strong>send_headers(array $headers = [], bool $replace = true): bool</strong><br>
    Sends raw or associative headers safely. If a header line includes an HTTP status, it will be recognized and handled.
  </li>

  <li>
    <strong>esc_html(string $text): string</strong><br>
    Escapes HTML special characters for safe output (using <code>ENT_QUOTES | ENT_SUBSTITUTE</code>).
  </li>

  <li>
    <strong>view(string $filename, ?array $vars = null): void</strong><br>
    Renders a view file with optional variables. This method is useful to call a view from within another view.<br>
    Example usage:<br>
    <pre><code>NanoMVC_Script_Helper&#8203;::view(&#8203;'pagination_view', $vars); // Similar parameters as the controller's view->display() method.</code></pre>
  </li>

  <li>
    <strong>is_int_like(mixed $value): bool</strong><br>
    Checks if a value is an integer or an integer-like string (e.g., <code>"42"</code> or <code>-7</code>).
  </li>
</ul>
