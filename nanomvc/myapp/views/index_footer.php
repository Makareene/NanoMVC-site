      <?php if(isset($controller) && $controller == 'Doc' && isset($method)):?>
      <p class="left"><a href="/doc">&larr; Back to Documentation</a></p>
      <?php endif?>
    </div>

    <footer>
    &copy; <?=(date('Y') != 2025 ? '2025 - ' . date('Y') : date('Y'))?>
    <?php if(isset($_SERVER['PATH_INFO'])):?>
    <a href="/">NanoMVC</a>.
    <?php else:?>
    NanoMVC.
    <?php endif?> All rights reserved.
    </footer>
  </body>
</html>
