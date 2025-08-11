<h1>Plugin: BlogMenu</h1>

<p>
The <code>blogmenu</code> plugin is a utility library designed to extract blog categories (controllers) and blog articles (controller methods) from your NanoMVC application. It uses structured metadata comments in both controllers and their methods.
</p>

<h2>How to Use</h2>

<pre><code>$this->load->library(&#8203;'blogmenu');
$categories = $this->blogmenu->&#8203;get_categories();
$articles = $this->blogmenu->&#8203;get_articles();</code></pre>

<h2>How to Define Metadata</h2>

<h3>Controller (Category)</h3>

<p>
At the top of your controller file, place the following metadata comment on the first line:
</p>

<pre><code>&lt;?php // -&gt; as categorie: { "name": "Category Name", "created": "2025-08-01 22:17" } ?&gt;</code></pre>

<ul>
  <li><code>name</code> – The name of the blog category</li>
  <li><code>created</code> – The date the category was created (format: <code>Y-m-d H:i</code>)</li>
</ul>

<h3>Method (Article)</h3>

<p>
For each method (must be public and not start with an underscore), add metadata in the PHPDoc using the
<code>@blog</code> tag:
</p>

<pre><code>/**
 * @blog {
 *   "name": "Customize Core",
 *   "description": "Learn how to safely override NanoMVC core without affecting updates.",
 *   "created": "2025-07-15 19:00"
 * }
 */</code></pre>

<ul>
  <li><code>name</code> – The menu title</li>
  <li><code>description</code> – Optional summary</li>
  <li><code>created</code> – Required timestamp (<code>Y-m-d H:i</code>)</li>
</ul>

<h2>Available Methods</h2>

<h3><code>get_categories(&#8203;?string $controller = null, string $order = 'created desc')</code></h3>

<p>
Scans controller files and returns an array of categories (controllers) with parsed metadata.
</p>

<ul>
  <li><code>$controller</code> – Optional: scan only one controller</li>
  <li><code>$order</code> – Sorting order by any metadata field (default: newest first)</li>
</ul>

<h3><code>get_articles(&#8203;?string $action = null, string $order = 'created desc', ?string $controller_name = null, ?string $act = null)</code></h3>

<p>
Scans the methods of the current or another controller and returns all articles with their metadata.
</p>

<ul>
  <li><code>$action</code> – Optional: limit to a specific method</li>
  <li><code>$order</code> – Sorting order (default: <code>created desc</code>)</li>
  <li><code>$controller_name</code> – Optional: name of another controller to load</li>
  <li><code>$act</code> – Optional: action name to pass when instantiating another controller</li>
</ul>

<p>
If <code>$controller_name</code> is provided, BlogMenu will try to load that controller from either the <code>myapp</code> or <code>myfiles</code> paths.
If not found, an exception will be thrown. When loaded, the controller will be instantiated with the given controller and action names, allowing metadata extraction from another controller's articles.
</p>

<h3>Get next and previous article: <code>get_nav(array &amp;$items, string $current): array</code></h3>

<p>
Returns <code>pre</code> and <code>next</code> items relative to the current article key.
</p>

<ul>
  <li><code>$items</code> – The array returned by <code>get_articles()</code></li>
  <li><code>$current</code> – The current method name</li>
</ul>

<pre><code>[
  'pre' => [ ... ],  // previous article or empty array
  'next' => [ ... ]  // next article or empty array
]</code></pre>

<h3><code>pagination(array &amp;$items, int $limit = 1): int|bool</code></h3>

<p>
Splits the list of articles into pages and adds a <code>_page</code> index to each article.
</p>

<ul>
  <li><code>$items</code> – The array returned by <code>get_articles()</code></li>
  <li><code>$limit</code> – Number of articles per page (must be positive)</li>
  <li><strong>Returns:</strong> Total number of pages, or <code>false</code> if <code>$limit</code> is 0</li>
</ul>

<p>
Each article in <code>$items</code> gets a <code>_page</code> key with its page number.
Example: if limit is 3 and you have 8 articles, they will be marked with pages 1, 1, 1, 2, 2, 2, 3, 3.
</p>

<h2>Validation</h2>

<ul>
  <li><code>name</code> and <code>created</code> are required in both category and article metadata</li>
  <li>Date format must be <code>Y-m-d H:i</code>; invalid formats throw an exception</li>
  <li>Malformed or missing JSON metadata will also result in an exception</li>
</ul>
