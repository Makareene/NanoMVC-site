<h1>Welcome to NanoMVC</h1>

<p>A minimalist and lightweight PHP MVC framework inspired by TinyMVC.</p>

<p>Use it for small to medium PHP projects with minimal configuration.</p>

<div class="button-group">
  <a class="btn" href="https://github.com/Makareene/NanoMVC" rel="nofollow" target="_blank">Download NanoMVC</a>
  <a class="btn" href="/doc">View Documentation</a>
</div>

<section class="section">
  <h2 class="header">⚙️ What is NanoMVC?</h2>
  <p>
  NanoMVC is an MVC (Model-View-Controller) application framework for PHP.
  It provides clear separation between the data (Model),
  the presentation (View), and the glue in between (Controller).
  </p>

  <h2 class="header">🚫 What NanoMVC is NOT</h2>
  <p>
  NanoMVC is NOT a full-featured framework. Out-of-the-box, it is a simple
  MVC structure with a database support layer (PDO). Every aspect of this
  framework is extendible via plugins.
  </p>

  <section class="nmvc-banner-section">
    <h3>🧩 Add NanoMVC to your site</h3>
    <p>If you'd like to support NanoMVC, feel free to place this banner on your website:</p>
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

</div>
