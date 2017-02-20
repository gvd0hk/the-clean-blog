<?php
/**
 * This file generates the background header image with the title and the subtitle.
 * 
 * The background image is added by using inline style.
 * @see cleanblog-functions.php | cleanblog_header_style()
 */
?>

<header id="masthead" class="site-header intro-header" role="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <header class="entry-header">
                        <?php
                        if (is_single() || is_page() || is_sticky() || is_front_page()) {
                            the_title('<h1 class="entry-title">', '</h1>');
                        } else {
                            the_title('<h1 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h1>');
                        }

                        ?>

                        <div class="strike">
                            <span>
                                <a href="#content"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                            </span>
                        </div>

                        <h2 class="subheading">
                            <?php
                            if ('post' || 'page' === get_post_type()) :
                                global $wp_query;
                                $postid = $wp_query->post->ID;
                                echo esc_html(get_post_meta($postid, '_unprefix_subtitle', true));
                                wp_reset_query();
                            endif;

                            ?>
                        </h2>
                    </header>                                             
                </div>
            </div>
        </div>
    </div>
</header>