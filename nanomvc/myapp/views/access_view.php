<h1>Access Plugin</h1>

<p>
The <strong>Access</strong> plugin provides authentication and authorization for NanoMVC applications.
Unlike many authentication systems, it does not require a database. Instead, all users, roles, and permission rules are stored in a single XML file, making the plugin easy to install, portable, and suitable for projects of any size.
</p>

<p>
The plugin consists of a single reusable library, <code>NanoMVC_Library_Access</code>. It is completely independent of the user interface. NanoMVC provides only the authentication and authorization engine. User management pages, administration panels, and other interfaces are implemented by the application itself.
</p>

<p>
The Access plugin supports:
</p>

<ul>
  <li>User authentication</li>
  <li>Role-based authorization</li>
  <li>Unlimited users and roles</li>
  <li>Wildcard matching for controllers and actions</li>
  <li>Four permission types (<code>r</code>, <code>w</code>, <code>c</code>, and <code>d</code>)</li>
  <li>Password activation and reset</li>
  <li>Automatic account locking after failed login attempts</li>
  <li>Automatic session invalidation whenever a user or one of their roles is modified</li>
  <li>Complete XML validation when users or roles are changed</li>
</ul>

<h2>When Should You Use It?</h2>

<p>
The Access plugin is intended for applications that need a lightweight authentication and authorization system without the overhead of a database.
Because all configuration is stored in XML, it is especially useful for administration panels, internal tools, documentation websites, embedded applications, prototypes, and small or medium-sized projects.
</p>

<p>
The plugin may also be used in larger applications. Since it is completely independent from the storage layer, developers are free to replace or extend the XML implementation if necessary.
</p>

<h2>Architecture</h2>

<p>
The Access plugin separates the authentication engine from the user interface.
The library is responsible for loading the XML configuration, validating users and roles, checking permissions, managing sessions, and updating the access file.
The application is responsible for presenting login pages, administration panels, and any other user interface.
</p>

<p>
A typical application architecture looks like this:
</p>

<pre><code>
Application Controllers
        │
        ▼
NanoMVC_Library_Access
        │
        ▼
      access.xml
</code></pre>

<p>
This separation allows the same library to be reused by different applications while each application implements its own administration interface and visual design.
</p>

<h2>Loading the Library</h2>

<p>
Like every NanoMVC library, the Access plugin can be loaded through the standard library loader:
</p>

<pre><code>$this->load->library(&#8203;'Access', 'access');
</code></pre>

<p>
The library is then available as:
</p>

<pre><code>$this->access
</code></pre>

<p>
Alternatively, the library may be loaded automatically by adding it to the application's autoload configuration.
</p>

<h2>Configuration</h2>

<p>
The plugin is configured through:
</p>

<pre><code>nanomvc/myapp/configs/&#8203;config_access.php</code></pre>

<p>
This configuration file defines:
</p>

<ul>
  <li>The location of the XML access file</li>
  <li>The session key</li>
  <li>Failed login limits</li>
  <li>Unlock timeout</li>
  <li>Other plugin-specific options</li>
</ul>

<h2>The Access File</h2>

<p>
By default, all users, roles, and permissions are stored in:
</p>

<pre><code>nanomvc/myapp/configs/access.xml</code></pre>

<p>
The XML file represents the complete security configuration of the application.
Every change performed through the library is immediately written back to this file.
</p>

<p>
Since the file contains user accounts and security rules, it should never be accessible through the web server.
It is recommended to place it outside the public document root whenever possible.
</p>

<h2>Permission Model</h2>

<p>
Permissions are assigned to roles rather than directly to users.
Each user may belong to one or more roles.
Each role contains one or more permission rules.
</p>

<p>
Every permission rule consists of three fields:
</p>

<ul>
  <li><strong>Controller</strong></li>
  <li><strong>Actions</strong> (optional)</li>
  <li><strong>Permissions</strong> (optional)</li>
</ul>

<p>
Example:
</p>

<pre><code>blog | create,edit | r,w
</code></pre>

<p>
Wildcards may be used for both controllers and actions.
This allows a single rule to authorize an entire controller or groups of actions.
</p>

<h2>Administration</h2>

<p>
NanoMVC intentionally does not include a predefined administration interface for the Access plugin.
Instead, applications are expected to implement their own user and role management according to their own requirements.
This keeps the library independent from any specific user interface while allowing complete flexibility.
</p>

<h2>Next Chapters</h2>

<p>
The following chapters describe every aspect of the Access plugin in detail:
</p>

<ul>
  <li>Configuration</li>
  <li>The XML file format</li>
  <li>Authentication</li>
  <li>Authorization</li>
  <li>Working with users</li>
  <li>Working with roles</li>
  <li>Permission rules</li>
  <li>Library API reference</li>
</ul>
