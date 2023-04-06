<?php
/**
 * the header file
 * 
 * @package cam-new-theme
 * @since 1.0.0
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="utf-8">
  <title>My new theme for TAFE</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

  <div id="top-navigation" class="sticky-top bg-light bg-lighten-md">
    <div class="container">
    <nav class="navbar navbar-expand-lg" aria-label="Eleventh navbar example">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'your-theme-slug' ); ?>">
          <span class="navbar-toggler-icon"></span>
        </button>
        <?php
            wp_nav_menu(
              array(
                'theme_location' => 'primary',
                'depth' => 2,
                'container' => 'div',
                'container_class' => 'collapse navbar-collapse justify-content-md-end',
                'container_id' => 'main-navbar',
                'menu_class' => 'navbar-nav me-auto mb-2 mb-lg-0 gap-3',
                'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                'walker' => new WP_Bootstrap_Navwalker(),
              ));
            ?>
      </div>
    </nav>

    </div>
  </div>