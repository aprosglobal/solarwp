<?php
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}
get_header();


// Loop de WordPress para mostrar las entradas
if (have_posts()) {
  while (have_posts()) {
    the_post();
?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <h2>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
          <?php the_title(); ?>
        </a>
      </h2>

      <div class="entry-content">
        <?php the_content(); ?>
      </div>
    </article>
<?php
  }
} else {
  // Si no hay entradas que mostrar
  echo 'Lo siento, no se encontraron entradas.';
}

get_sidebar();
get_footer();
?>