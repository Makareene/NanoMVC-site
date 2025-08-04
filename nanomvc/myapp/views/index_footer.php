      <?php if(isset($controller) && $controller == 'Doc' && isset($method)):?>
        <?php if(isset($nav)):?>
        <p>
          <?php if(isset($nav['pre']) && $nav['pre']):?>
            <a href="<?=$nav['pre']['_link']?>" class="btn-download">&larr; to <?=$nav['pre']['name']?></a>
          <?php endif?>
          <?php if(isset($nav['next']) && $nav['next']):?>
            <a href="<?=$nav['next']['_link']?>" class="btn-download">to <?=$nav['next']['name']?> &rarr;</a>
          <?php endif?>
        </p>
        <?php endif?>
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
