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
  <li>XML-based storage without requiring a database</li>
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

<pre><code>Application Controllers
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
The plugin is configured through the application configuration.
The Access configuration defines the XML file location, the session key, and the failed login limit.
</p>

<p>
Example:
</p>

<pre><code>return [
  'access' => [
    'file'        => 'configs/access.xml'
   ,'session_key' => 'nanomvc_access_user'
   ,'max_failed'  => 3
  ]
];
</code></pre>

<ul>
  <li><code>file</code> defines the XML access file location.</li>
  <li><code>session_key</code> defines the session key used to store the authenticated user.</li>
  <li><code>max_failed</code> defines how many failed login attempts are allowed before an account requires unlocking.</li>
</ul>

<p>
If the access file path is relative, NanoMVC resolves it from the application directory.
</p>

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

<h3>Example access.xml</h3>

<pre><code>&lt;access&gt;
  &lt;users&gt;
    &lt;user login="admin"
          roles="admin"
          password=""
          secret="secret-code"
          failed="0"
          changed="2026-06-26 12:00:00.000000" /&gt;
  &lt;/users&gt;

  &lt;roles&gt;
    &lt;role name="admin"&gt;
      &lt;rule controller="*" actions="*" permissions="r,w,c,d" /&gt;
    &lt;/role&gt;
  &lt;/roles&gt;
&lt;/access&gt;
</code></pre>

<h2>Users</h2>

<p>
Users are stored inside the <code>&lt;users&gt;</code> section of the XML file.
Each user has a login, one or more roles, password data, failed login counter, and a change marker.
</p>

<p>
Example:
</p>

<pre><code>&lt;user login="admin"
      roles="admin,manager"
      password=""
      secret="secret-code"
      failed="0"
      changed="2026-06-26 12:00:00.000000" /&gt;
</code></pre>

<ul>
  <li><code>login</code> is the user name.</li>
  <li><code>roles</code> is a comma-separated list of assigned roles.</li>
  <li><code>password</code> stores the hashed password after activation.</li>
  <li><code>secret</code> is used for account activation.</li>
  <li><code>unlock</code> is used for account unlocking after too many failed login attempts.</li>
  <li><code>failed</code> stores the number of failed login attempts.</li>
  <li><code>changed</code> stores the last user-related change timestamp.</li>
</ul>

<p>
User names may contain only letters, numbers, and underscores.
</p>

<h2>Roles</h2>

<p>
Roles are stored inside the <code>&lt;roles&gt;</code> section of the XML file.
A role groups one or more permission rules.
Users receive permissions through their assigned roles.
</p>

<p>
Example:
</p>

<pre><code>&lt;role name="manager"&gt;
  &lt;rule controller="blog" actions="index,view" permissions="r" /&gt;
  &lt;rule controller="blog" actions="create,edit" permissions="r,w,c" /&gt;
&lt;/role&gt;
</code></pre>

<p>
Role names may contain only letters, numbers, and underscores.
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
This rule means that the role has read and write permissions for the <code>create</code> and <code>edit</code> actions of the <code>blog</code> controller.
</p>

<h3>Permissions</h3>

<p>
The Access plugin uses four basic permission types:
</p>

<ul>
  <li><code>r</code> — read</li>
  <li><code>w</code> — write or update</li>
  <li><code>c</code> — create</li>
  <li><code>d</code> — delete</li>
</ul>

<p>
Permissions are comma-separated:
</p>

<pre><code>r,w,c,d
</code></pre>

<h3>Wildcards</h3>

<p>
Wildcards may be used for controllers and actions.
</p>

<pre><code>* | * | r,w,c,d
</code></pre>

<p>
This rule allows all actions on all controllers with all permissions.
</p>

<p>
Controller names may be lowercase letters, numbers, underscores, or a single <code>*</code>.
Action names may contain lowercase letters, numbers, underscores, and wildcards.
</p>

<h2>Authentication</h2>

<p>
The login process verifies a user's login and password.
If authentication succeeds, the user data is stored in the session.
</p>

<pre><code>$this->access->login(&#8203;$login, $password);
</code></pre>

<p>
To check whether a user is logged in:
</p>

<pre><code>if ($this->access->is_logged()) {
  // user is logged in
}
</code></pre>

<p>
To get the current session user:
</p>

<pre><code>$user = $this->access->user();
</code></pre>

<p>
To log out:
</p>

<pre><code>$this->access->logout();
</code></pre>

<h2>Activation</h2>

<p>
A newly created user may be activated using a secret code.
During activation, the user sets a password and receives an unlock key.
</p>

<pre><code>$this->access->activate($login, $secret, $password);
</code></pre>

<p>
Activation removes the secret code and stores the hashed password.
</p>

<h2>Generating an Activation Secret</h2>

<p>
If a user does not yet have a password, an activation secret may be generated:
</p>

<pre><code>$res = $this->access->generate($login);
</code></pre>

<p>
The result contains:
</p>

<pre><code>[
  'login'  =&gt; $login,
  'secret' =&gt; $secret
]
</code></pre>

<p>
The application may use this data to build and send an activation link.
</p>

<h2>Resetting a User</h2>

<p>
Resetting a user clears the password, removes the unlock key, resets the failed login counter, and generates a new activation secret.
</p>

<pre><code>$res = $this->access->reset($login);
</code></pre>

<p>
A user cannot reset themselves.
</p>

<h2>Unlocking a User</h2>

<p>
If a user exceeds the configured failed login limit, the account requires unlocking.
</p>

<pre><code>$this->access->unlock($login, $unlock);
</code></pre>

<p>
After a successful unlock, the user may try logging in again.
</p>

<h2>Authorization</h2>

<p>
Authorization is performed by checking whether the current user has a specific permission for a controller and action.
</p>

<pre><code>$this->access->check($controller, $action, NanoMVC_Library_Access::&#8203;PERMISSION_READ);
</code></pre>

<p>
If access is denied, the method throws an exception.
</p>

<p>
The available permission constants are:
</p>

<pre><code>NanoMVC_Library_Access::&#8203;PERMISSION_READ
NanoMVC_Library_Access::&#8203;PERMISSION_WRITE
NanoMVC_Library_Access::&#8203;PERMISSION_CREATE
NanoMVC_Library_Access::&#8203;PERMISSION_DELETE
</code></pre>

<h2>Navigation Maps</h2>

<p>
The Access plugin can build permission-aware navigation maps.
This is useful for showing only menu items that the current user is allowed to access.
</p>

<pre><code>$items = [
  'user' =&gt; 'users,user_create,user_reset,&#8203;user_delete,generate',
  'role' =&gt; 'index,role_create'
];

$map = $this->access->map($items);
</code></pre>

<p>
The result contains only controllers and actions allowed for the current user.
</p>

<h2>User Management</h2>

<p>
The Access plugin provides methods for creating, updating, deleting, and listing users.
</p>

<h3>Creating a User</h3>

<pre><code>$this->access->create(&#8203;$login, $roles);
</code></pre>

<p>
Roles are passed as a comma-separated string:
</p>

<pre><code>admin,manager
</code></pre>

<p>
Every role must already exist. If a role does not exist, the method throws an exception.
</p>

<h3>Updating a User</h3>

<pre><code>$this->access->update($login, $new_login, $roles);
</code></pre>

<p>
This method may rename the user and replace all assigned roles.
If the login changes, the new login must not already exist.
</p>

<h3>Deleting a User</h3>

<pre><code>$this->access->delete($login);
</code></pre>

<p>
A user cannot delete themselves.
</p>

<h3>Listing Users</h3>

<pre><code>$users = $this->access->users();
</code></pre>

<p>
The method returns information about logins, roles, activation state, blocked state, and failed login count.
</p>

<h2>Role Management</h2>

<p>
The Access plugin provides methods for creating, updating, deleting, and listing roles.
</p>

<h3>Listing Roles</h3>

<pre><code>$roles = $this->access->roles();
</code></pre>

<p>
By default, this returns role names and the number of rules in each role.
</p>

<p>
To load one role with full rules:
</p>

<pre><code>$role = $this->access->roles(&#8203;'admin', false);
</code></pre>

<h3>Creating a Role</h3>

<pre><code>$this->access->role_create(&#8203;$role_name, $rules);
</code></pre>

<p>
The rules string contains one rule per line:
</p>

<pre><code>* | * | r,w,c,d
blog | index,view | r
blog | create,edit | r,w,c
</code></pre>

<h3>Updating a Role</h3>

<pre><code>$this->access->role_update($role_name, $new_role_name, $rules);
</code></pre>

<p>
This method may rename the role and replace all existing rules with the new rule set.
If the role name changes, all users assigned to the old role are updated automatically.
</p>

<h3>Deleting a Role</h3>

<p>
A role is deleted by passing an empty rules string to <code>role_update()</code>:
</p>

<pre><code>$this->access->role_update($role_name, $role_name, '');
</code></pre>

<p>
When a role is deleted, it is also removed from every user that has it.
</p>

<h2>Rule Text Format</h2>

<p>
Role rules may be represented as plain text:
</p>

<pre><code>controller | actions | permissions
</code></pre>

<p>
Examples:
</p>

<pre><code>* | * | r,w,c,d
user | users,user_create | r,c
blog | index,view | r
blog | create,edit | r,w,c
</code></pre>

<p>
Empty lines are ignored.
The controller is required.
Actions and permissions are optional.
</p>

<p>
The following examples are valid:
</p>

<pre><code>blog
blog |
blog | |
blog | index,view
blog | index,view | r,w
</code></pre>

<h2>Session Invalidation</h2>

<p>
Every user has a <code>changed</code> attribute.
This value is stored in the session when the user logs in.
On later requests, the plugin compares the session value with the current XML value.
</p>

<p>
If the values are different, the session is no longer valid and the user must sign in again.
This prevents users from continuing to work with outdated permissions after their account or roles have been changed.
</p>

<pre><code>$check = $this->access->check_session();
</code></pre>

<p>
The method returns one of the following constants:
</p>

<pre><code>NanoMVC_Library_Access::&#8203;SESSION_OK
NanoMVC_Library_Access::&#8203;SESSION_NOT_LOGGED
NanoMVC_Library_Access::&#8203;SESSION_USER_DELETED
NanoMVC_Library_Access::&#8203;SESSION_USER_CHANGED
</code></pre>

<h2>Administration</h2>

<p>
NanoMVC intentionally does not include a predefined administration interface for the Access plugin.
Instead, applications are expected to implement their own user and role management according to their own requirements.
This keeps the library independent from any specific user interface while allowing complete flexibility.
</p>

<p>
For example, an application may provide controllers for:
</p>

<ul>
  <li>Login and logout</li>
  <li>User creation and update</li>
  <li>User reset and deletion</li>
  <li>Role creation and update</li>
  <li>Permission rule editing</li>
</ul>

<p>
These controllers should use <code>NanoMVC_Library_Access</code> instead of editing the XML file directly.
</p>

<h2>Security Notes</h2>

<ul>
  <li>Never expose <code>access.xml</code> through the web server.</li>
  <li>Do not edit the XML file directly while users are working unless you understand the session invalidation behavior.</li>
  <li>Use HTTPS for login, activation, and unlock pages.</li>
  <li>Keep activation secrets private.</li>
  <li>Use strong passwords for administrator accounts.</li>
  <li>Keep administration controllers protected by Access permissions.</li>
</ul>

<h2>Summary</h2>

<p>
The Access plugin provides a complete XML-based authentication and authorization engine for NanoMVC.
It keeps the core security logic inside a reusable library while allowing each application to build its own administration interface.
</p>

<p>
This makes it suitable for small projects, internal tools, documentation websites, administration panels, and any application that needs simple but flexible access control without requiring a database.
</p>
