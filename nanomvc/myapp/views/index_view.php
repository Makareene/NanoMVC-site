<h1>Welcome to NanoMVC</h1>

<p>
NanoMVC is a lightweight PHP MVC framework designed for developers who want
full control over their application without the complexity of large frameworks.
</p>

<p>
Inspired by TinyMVC and modernized for PHP 8.3+, NanoMVC focuses on simplicity,
readability, and extensibility.
</p>

<div class="button-group">
  <a class="btn" href="https://github.com/Makareene/NanoMVC" rel="nofollow" target="_blank">Download NanoMVC</a>
  <a class="btn" href="/doc">View Documentation</a>
</div>

<section class="section">
  <h2 class="header">⚙️ What is NanoMVC?</h2>
  <p>
  NanoMVC is an MVC (Model-View-Controller) application framework for PHP.
  Controllers handle requests, models contain business logic, and views generate output.
  </p>

  <p>
  It gives you a small, readable foundation for building PHP applications without
  service containers, code generators, annotations, or hidden magic.
  </p>

  <h2 class="header">⚡ Core Features</h2>
  <ul>
    <li>PHP 8.3+ compatible</li>
    <li>Lightweight MVC architecture</li>
    <li>PDO database support</li>
    <li>Custom database plugin support</li>
    <li>Controller, model, view, and config discovery</li>
    <li>Simple reusable library system</li>
    <li>Built-in error and exception handling</li>
    <li>Flexible application structure</li>
    <li>Easy framework customization</li>
  </ul>

  <h2 class="header">🚫 What NanoMVC is NOT</h2>
  <p>
  NanoMVC is not a full-stack framework. It does not try to solve every problem
  for you. Instead, it provides a small and understandable MVC core that you can
  extend however you like.
  </p>

  <h2 class="header">📚 Learn More</h2>
  <p>
  Visit the documentation to learn about controllers, views, models, libraries,
  database plugins, error handling, and framework customization.
  </p>

  <section class="nmvc-banner-section">
    <h3>🧩 Add NanoMVC to your site</h3>
    <p>If you'd like to support NanoMVC, feel free to place this small banner on your website:</p>
    <img src="/banner.webp" alt="NanoMVC framework" width="88" height="31" loading="lazy">
    <pre><code>&lt;a href="https://nanomvc&#8203;.nipaa.fyi" rel="nofollow"&gt;
  &lt;img src="https://nanomvc&#8203;.nipaa.fyi/banner.webp" width="88" height="31" alt="NanoMVC framework"&gt;
&lt;/a&gt;</code></pre>
    <button class="copy-btn" onclick="copyCode(this)">Copy</button>

    <script>
      function copyCode(button) {
        const code = button.previousElementSibling.innerText;
        navigator.clipboard.writeText(code).then(() => {
          button.textContent = 'Copied!';
          setTimeout(() => {
            button.textContent = 'Copy';
          }, 1500);
        }).catch(() => {
          button.textContent = 'Failed';
        });
      }
    </script>
  </section>
</section>
