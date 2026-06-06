      <h1>Documentation</h1>

      <p>
      Welcome to the NanoMVC documentation. This guide covers everything you need to build applications with NanoMVC, a lightweight PHP MVC framework focused on simplicity, readability, and extensibility.
      </p>

      <p>
      NanoMVC provides a clean separation between controllers, models, and views while remaining easy to understand and customize. Whether you are building a small website, a REST API, a personal blog, or a business application, NanoMVC gives you a lightweight foundation without unnecessary complexity.
      </p>

      <h2>Documentation Sections</h2>

      <p>
      Explore the topics below to learn how NanoMVC works and how to adapt it to your own projects.
      </p>

      <?php if($articles):?>
      <ul class="doc-list">
        <?php foreach($articles as $article):?>
        <li>
          <a href="<?=$dh->esc_html($article['_link'])?>"><?=$dh->esc_html($article['name'])?></a>
          <p class="doc-desc"><?=$dh->esc_html($article['description'])?></p>
        </li>
        <?php endforeach?>
      </ul>
      <?php endif?>

      <p>
      Use the links above or scroll to read more. Whether you're new to MVC frameworks or transitioning from TinyMVC, this guide is your starting point.
      </p>
