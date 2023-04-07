<?php
/**
 * title banner and subscribe bar
 * 
 * @package cam-new-theme
 * @since 1.0.0
 */

$blog_info = get_bloginfo('name');
$description = get_bloginfo('description', 'display');

?>

<section class="title-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1 col-sm-12 offset-sm-0 overflow-hidden text-center">
                <?php
                if (is_page()) {

                    the_title('<h1 class="page-title">', '</h1>');

                } elseif (is_single()) {
                    ?>
                    <p class="tag-line sub-title">
                        <?php echo get_the_date('M d, Y'); ?>
                    </p>
                    <?php
                    the_title('<h1 class="page-title">', '</h1>');

                } elseif (!is_front_page() && is_home()) {

                    $camnewtheme_blog_title = get_the_title(get_option('page_for_posts', true));

                    ?>

                    <h1 class="page-title">
                        <?php echo esc_html($camnewtheme_blog_title); ?>
                    </h1>

                    <?php
                } elseif (is_home()) {

                    if ($description) {
                        ?>

                        <p class="tag-line sub-title">
                            <?php echo esc_html($description) ?>
                        </p>

                        <?php
                    }
                    ?>

                    <h1>
                        <?php echo esc_html($blog_info) ?>
                    </h1>

                    <?php
                } elseif (is_archive()) {

                    the_archive_title('<h1 class="page-title">', '</h1>');

                } elseif (is_404()) {
                    ?>

                    <p class="tag-line sub-title">404</p>
                    <h1>
                        <?php esc_html_e("Couldn't Be Found", "camnewtheme"); ?>
                    </h1>

                    <?php
                } elseif (is_search()) {

                    $search_title = sprintf('%s %s', __('Search results for: ', 'camnewtheme'), get_search_query());
                    ?>

                    <h1 class="page-title">
                        <?php echo esc_html($search_title); ?>
                    </h1>

                    <?php
                }

                ?>
            </div>
        </div>
    </div>
</section>
<?php if (is_active_sidebar('camnewtheme-subscribe-widget')): ?>
<section class="subscribe-bar">
  <div class="container">
    <div class="row flex-vertical-center">
          <aside class="camnewtheme-subscribe-widget">
            <?php dynamic_sidebar('camnewtheme-subscribe-widget'); ?>
          </aside>
    </div>
  </div>
</section>
<?php endif;