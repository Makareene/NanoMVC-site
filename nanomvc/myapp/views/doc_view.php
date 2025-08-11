      <h1>Documentation</h1>

      <p>
      Welcome to the NanoMVC documentation. This guide will walk you through everything you need to know to start working with NanoMVC — a minimalist PHP MVC framework inspired by TinyMVC. Whether you're building a small web application or a lightweight API service, NanoMVC helps you stay organized with a clean separation of concerns.
      </p>

      <p>
      NanoMVC retains the simplicity and clarity of TinyMVC while introducing modern touches and enhancements. It’s perfect for developers who prefer control and minimalism over heavyweight frameworks.
      </p>

      <h2>Documentation Sections</h2>

      <p>
      Explore the following topics:
      </p>

      <?php if($articles):?>
      <ul class="doc-list">
        <?php foreach($articles as $article):?>
        <li>
          <a href="<?=$dh::esc_html($article['_link'])?>"><?=$dh::esc_html($article['name'])?></a>
          <p class="doc-desc"><?=$dh::esc_html($article['description'])?></p>
        </li>
        <?php endforeach?>
      </ul>
      <?php endif?>

      <p>
      Use the links above or scroll to read more. Whether you're new to MVC frameworks or transitioning from TinyMVC, this guide is your starting point.
      </p>
