<?php get_header(); ?>

<body <?php body_class(); ?>>
  <main>
    <div class="max-w-screen-xl mx-auto p-4 h-full flex flex-col justify-center items-center">
      <?php
      if (have_posts()) :
        while (have_posts()) : the_post();
      ?>
          <article>
            <h2>
              <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
              </a>
            </h2>
            <div>
              <?php the_excerpt(); ?>
            </div>
          </article>
      <?php
        endwhile;
      else :
        echo '<p>No posts found.</p>';
      endif;
      ?>
  </main>
</body>


<?php get_footer(); ?>