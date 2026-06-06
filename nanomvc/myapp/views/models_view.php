<h1>Models</h1>

<h2>What is a model?</h2>
<p>Models are the layer of the MVC that are used to aggregate data. The underlying data source is typically a database, although this can be any type of source such as a flat file.</p>

<h2>Learning by example</h2>
<p>Model files are stored in the <code>/myapp/models/</code> directory. Here's a basic example:</p>
<pre><code>/myapp/
  /models/
    page_model.php</code></pre>

<pre><code>class Page_Model extends NanoMVC_Model {

  public function get_title(): string {
    return 'Hello';
  }

  public function get_body_text(): string {
    return 'Hello World.';
  }

}</code></pre>

<p>
Model files are normally named using the <code>_model.php</code> suffix.
For example, the <code>Page_Model</code> class is typically stored in
<code>page_model.php</code>.
</p>

<p>To use a model from a controller:</p>
<pre><code>class Hello_Controller extends NanoMVC_Controller {
  public Page_Model $page; // Declare the model property

  public function index(): void {
    $this->load->model('Page', 'page'); // declared model property
    // The connection is cached; to reconnect, set $this->page = null

    $title = $this->page->get_title();
    $body_text = $this->page->get_body_text();

    $this->view->assign('title', $title);
    $this->view->assign('body_text', $body_text);
    $this->view->display(&#8203;'hello');
  }
}</code></pre>
<p>
Before loading a model, declare the target property in your controller.
NanoMVC validates that the property exists before assigning the model instance.
</p>
<p>By default, the model will use the <code>default</code> pool from the database configuration. You may load from a specific connection pool like this:</p>
<pre><code>$this->load->model('Page', 'page', 'mypool');</code></pre>
<p>Multiple connection pools are supported and defined in your <code>config_database.php</code> file.</p>

<h2>Using the PDO database layer</h2>
<p>NanoMVC uses PDO for database access. Example:</p>
<pre><code>class Members_Model extends NanoMVC_Model {
  public function get_members(): array {
    $this->db->query('select * from members');
    while($row = $this->db->next()) $results[] = $row;
    return $results;
  }
}</code></pre>

<p>Or:</p>
<pre><code>public function get_member(int $id): array|false {
  return $this->db->query_one('select * from members where id = ?', [$id]);
}</code></pre>

<p>Or:</p>
<pre><code>public function get_members(): array {
  return $this->db->query_all('select * from members');
}</code></pre>

<p>You can pass <code>PDO::FETCH_ASSOC</code>, <code>PDO::FETCH_NUM</code> or <code>PDO::FETCH_BOTH</code> as a third parameter in <code>query</code> methods.</p>

<p>Build complex queries:</p>
<pre><code>public function get_members(): array {
  $this->db->select('my.foo, my.bar, my.baz'); // select specific columns from the database
  $this->db->from('mytable my'); // set the table to select data from (alias "my")
  $this->db->where('my.foo', 'test'); // add a WHERE condition: my.foo = 'test'
  $this->db->orwhere('my.foo = ? and my.bar = ?', ['test', 'test2']); // add an OR condition using parameter binding for security
  $this->db->join('jointable j', 'j.foo = my.foo', 'LEFT'); // add a LEFT JOIN with "jointable" on the condition j.foo = my.foo
  $this->db->in('my.column', ['any1', 'any2'], false); // add a WHERE IN clause with values quoted safely using PDO
  $this->db->orin('my.other_column', 'val1, val2', true); // add an OR IN clause with raw values — only use if you're sure inputs are safe
  $this->db->orderby('my.ordercolumn, j.ordercolumn desc'); // add ORDER BY clause to sort the results
  $this->db->groupby(&#8203;'my.groupbycolumn'); // add GROUP BY clause to group the results
  $this->db->limit(20, 0); // limit the result to 20 rows starting from offset 0
  $this->db->query(); // execute the assembled query
  while($row = $this->db->next()) $rows[] = $row;
  return $rows;
}</code></pre>

<p>
NanoMVC includes a lightweight PDO-based database layer and supports custom database plugins.
You may also use raw SQL queries directly.
</p>

<p>Examples:</p>
<pre><code>$this->db->query_all('select * from members where foo = ? and bar = ?', ['test', 'test2']);</code></pre>

<pre><code>$this->db->where('id', 1);
$this->db->update('tablename', ['col1' => 'val1']);</code></pre>
<p>Returns <code>true</code> on success.</p>

<pre><code>$this->db->insert('tablename', ['col1' => 'val1']);</code></pre>
<p>Returns inserted ID.</p>

<pre><code>$this->db->where('id', 1);
$this->db->delete('tablename');</code></pre>
<p>Returns <code>true</code> on success. <strong>Always use WHERE with delete()</strong> to avoid wiping entire tables.</p>

<h3>Available methods</h3>
<ul>
  <li><code>query()</code> — execute a query and loop with <code>next()</code></li>
  <li><code>query_all()</code> — return all records</li>
  <li><code>query_one()</code> — return one record</li>
  <li><code>next()</code> — fetch next row</li>
  <li><code>last_insert_id()</code> — get last insert ID</li>
  <li><code>num_rows()</code> — number of rows from last SELECT</li>
  <li><code>affected_rows()</code> — rows affected by last INSERT/UPDATE/DELETE</li>
  <li><code>last_query(bool $show_params)</code> — see the last query string, optionally with params</li>
</ul>

<h2>Access PDO object directly</h2>
<p>If you want to use the PDO object directly, it is available as <code>$this->db->pdo</code>. This allows you to use full PDO functionality, but you'll need to handle syntax, quoting, and errors manually.</p>
<pre><code>public function get_members(): array|false {
  $results = [];

  try {
    foreach ($this->db->pdo->query('select * from members') as $row)
      $results[] = $row;
  } catch (PDOException $e) {
    trigger_error($e->getMessage());
    return false;
  }

  return $results;
}</code></pre>

<h2>Database Configuration</h2>

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
   ,'charset'    => 'utf8mb4'     // Character set
   ,'port'       => 3306          // Optional port
   ,'schema'     => 'public'      // PostgreSQL schema
   ,'dsn'        => ''            // Custom DSN (overrides other connection settings)
  ]
];
</code></pre>

<ul>
  <li><code>default_pool</code> specifies which connection will be used by default</li>
  <li><code>default</code> is the name of a database connection pool</li>
  <li>You can define multiple pools by adding additional connection definitions</li>
  <li>Use <code>NanoMVC_PDO</code> unless you have your own database plugin</li>
</ul>

<p><strong>Note:</strong> The <code>NanoMVC_PDO</code> plugin is officially tested with <code>MySQL</code> and <code>PostgreSQL</code>. Other PDO-supported drivers (like <code>sqlite</code>, <code>sqlsrv</code>, etc.) may work but are not guaranteed or supported by default.</p>

<h2>Model Discovery</h2>

<p>
NanoMVC automatically locates model files using its model discovery system.
When loading:
</p>

<pre><code>$this->load->model('Page', 'page');</code></pre>

<p>
NanoMVC automatically resolves the corresponding file, such as
<code>page_model.php</code>, without requiring a filename to be specified.
</p>
