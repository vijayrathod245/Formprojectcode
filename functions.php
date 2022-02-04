<?php

/**
 * OceanWP Child Theme Functions
 *
 * When running a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions will be used.
 *
 * Text Domain: oceanwp
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

/**
 * Load the parent style.css file
 *
 * @link http://codex.wordpress.org/Child_Themes
 */
function oceanwp_child_enqueue_parent_style()
{

    // Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update the theme).
    $theme   = wp_get_theme('OceanWP');
    $version = $theme->get('Version');

    // Load the stylesheet.
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('oceanwp-style'), $version);
    wp_enqueue_style('custom-style', get_stylesheet_directory_uri() . '/css/style.css', array('oceanwp-style'), $version);
    wp_enqueue_style('custom-font-style', get_stylesheet_directory_uri() . '/css/fonts.css', array('oceanwp-style'), $version);
    wp_enqueue_style('custom-all-min-style', get_stylesheet_directory_uri() . '/css/all.min.css', array('oceanwp-style'), $version);
    wp_enqueue_style('custom-all-owl-style',  'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
    wp_enqueue_style('custom-all-owl2-style',  'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css');

    wp_enqueue_style('slick-style', get_stylesheet_directory_uri() . '/css/slick.css', array('oceanwp-style'), $version);
    wp_enqueue_style('slick-theme-style', get_stylesheet_directory_uri() . '/css/slick-theme.css', array('oceanwp-style'), $version);

    wp_enqueue_script('script1', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js');
    wp_enqueue_script('script2', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js');
    //wp_enqueue_script( 'jquery-3-min', get_stylesheet_directory_uri() . '/js/jquery-3.6.0.min.js', array(), $version  );
    wp_enqueue_script('slick', get_stylesheet_directory_uri() . '/js/slick.js', array(), $version);
    wp_enqueue_script('scriptjs5', get_stylesheet_directory_uri() . '/js/cstm.js', array(), $version);
}

add_action('wp_enqueue_scripts', 'oceanwp_child_enqueue_parent_style');


// Custom Carousel Custom Post Type
function carousel_init()
{
    // set up  labels
    $labels = array(
        'name' => 'Carousel',
        'singular_name' => 'Carousel',
        'add_new' => 'Add New Carousel',
        'add_new_item' => 'Add New Carousel',
        'edit_item' => 'Edit Carousel',
        'new_item' => 'New Carousel',
        'all_items' => 'All Carousel',
        'view_item' => 'View Carousel',
        'search_items' => 'Search Carousel',
        'not_found' =>  'No Carousel Found',
        'not_found_in_trash' => 'No Carousel found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Carousel',
    );

    // register post type
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'carousel'),
        'query_var' => true,
        /*'menu_icon' => 'dashicons-plus-alt',*/
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes'
        )
    );
    register_post_type('carousel', $args);
}
add_action('init', 'carousel_init');

// register taxonomy
register_taxonomy('carousel', 'carousel', array('hierarchical' => true, 'label' => 'Carousel Category', 'query_var' => true, 'rewrite' => array('slug' => 'carousel-category')));











/*add_shortcode('custom-carousel', 'add_custom_carousel');

function add_custom_carousel()
{ ?>


    <section class="slider-section">
        <div class="container-slider-info">
            <div class="row">
                <?php

                $args = array(
                    'post_status' => 'publish',
                    'post_type' => 'carousel',
                    'posts_per_page' => -1,
                );
                $loop = new WP_Query($args);
                ?>

                <div class="w-100 slider">
                    <div class="owl-carousel owl-theme">
                        <?php
                        while ($loop->have_posts()) : $loop->the_post();
                        ?>
                            <div class="item">
                                <div class="slider-hover">
                                    <div class="slider-img mb-50">
                                        <?php $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'thumbnail'); ?>
                                        <img class="indus-sec-img" src="<?php echo $url ?>" alt="">
                                    </div>
                                    <div class="slider-content">
                                        <a href="<?php the_field('link'); ?>" class="btn btn-1"><?php the_field('button'); ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                                                <path d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z" />
                                            </svg>
                                        </a>

                                        <h4 class="mb-20"><?php the_title();  ?></h4>
                                        <p class="w-70"><?php the_excerpt(); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script type="text/javascript">
        $('.owl-carousel').owlCarousel({
            loop: false,
            margin: 100,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 2
                },
                1200: {
                    items: 2
                }
            }
        });
    </script>
    </body>

    </html>

<?php }*/

/* Projet Section Code */

add_action('init', 'project_register');

function project_register()
{

    $labels = array(
        'name' => _x('Projects', 'post type general name'),
        'singular_name' => _x('Project', 'post type singular name'),
        'add_new' => _x('Add New', 'Project'),
        'add_new_item' => __('Add New Project'),
        'edit_item' => __('Edit Project'),
        'new_item' => __('New Project'),

        'view_item' => __('View Project'),
        'search_items' => __('Search Project'),
        'not_found' => __('Nothing found'),
        'not_found_in_trash' => __('Nothing found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'project', 'with_front' => false),
        'capability_type' => 'post',
        'hierarchical' => false,
        'has_archive' => true,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields')
    );

    register_post_type('project', $args);

    register_taxonomy(
        'categories',
        array('project'),
        array(
            'hierarchical' => true,
            'label' => 'Categories',
            'singular_label' => 'Category',
            'rewrite' => array('slug' => 'categories', 'with_front' => false)
        )
    );

    register_taxonomy_for_object_type('categories', 'project');
}


add_shortcode('project-portfolio', 'add_project_portfolio');
function add_project_portfolio()
{
    $product_parent_category = get_terms('categories', array('hide_empty' => 0, 'orderby' => 'ASC',  'parent' => 0));
?>
    <div id="portfolio" class="portfolio">

        <div class="">
            <div class="accordion" id="accordionExample">
                <div class="filters card p-4">
                    <div class="card-head  d-flex align-items-center justify-content-between">
                        <div id="headingOne">
                            <span class="mb-0 d-inline-block pr-5" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Refine Result
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="10.409" viewBox="0 0 18 10.409">
                                    <path d="M224.6,203.282l6.668-6.874a1.4,1.4,0,0,1,1.893-.084,1.2,1.2,0,0,1,.09,1.775l-7.66,7.9a1.4,1.4,0,0,1-1.984,0l-7.66-7.9a1.2,1.2,0,0,1,.09-1.775,1.4,1.4,0,0,1,1.894.084Z" transform="translate(-215.601 -195.996)" />
                                </svg>
                            </span>
                        </div>
                        <a href="javascript:void(0)" class=" float-right text-decoration-none">
                            <ul class="">

                                <li class="active list-unstyled" id="all">
                                    Clear all
                                </li>
                            </ul>
                        </a>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <?php
                        foreach ($product_parent_category as $pcatTerm) : ?>
                            <div class="border-top mt-3 mb-3"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row ext-info">
                                        <div class="col-md-2 col-12">
                                            <h6><?php echo $pcatTerm->name; ?></h6>
                                        </div>
                                        <?php
                                        $psubargs = array(
                                            'post_type' => 'project',
                                            'hierarchical' => false,
                                            'show_option_none' => '',
                                            'hide_empty' => 0,
                                            'parent' => $pcatTerm->term_id,
                                            'taxonomy' => 'categories'
                                        );
                                        $psubcats = get_categories($psubargs);
                                        foreach ($psubcats as $psc) :
                                            $product_cat_term = $psc->name;
                                            $product_cat_slug = $psc->slug;

                                        ?>
                                            <div class="col-md-2 cat-name-info">
                                                <ul>
                                                    <li class="list-unstyled" id="<?php echo $product_cat_slug; ?>"><?php echo $psc->name; ?></li>
                                                </ul>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="row">
                    <?php
                    $post_type1 = 'project';
                    $taxonomy1 = 'categories';

                    $argsss = [
                        'post_type' => $post_type1,
                        'hierarchical' => false,
                        "orderby" => "date",
                        "order" => "DESC",
                        'posts_per_page' => -1
                    ];

                    $queryss = new WP_Query($argsss);
                    while ($queryss->have_posts()) {
                        $queryss->the_post();

                        $termsss = get_the_terms($post->ID, $taxonomy1);
                        $categories_proj = [];

                        foreach ($termsss as $category) {
                            $categories_proj = $category->slug;
                            $categories_proj_name = $category->name;
                        }

                    ?>
                        <div class="col-lg-4 col-md-6 col-12 mt-3 pt-3 all <?php echo $categories_proj; ?>">
                            <div class="">
                                <?php $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'thumbnail'); ?>
                                <a href="<?php the_permalink(); ?>"><img class="img-fluid" src="<?php echo $url ?>" alt=""></a>
                            </div>
                            <div class="bg-white p-3 card-box content-info">
                                <?php
                                $categories_proj = implode(', ', $categories_proj);
                                echo '' . $categories_proj_name . ''; ?>
                                <h5 class="pb-2"><?php echo get_the_title(); ?></h5>
                                <p><?php echo get_excerpt(100); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary text-black custom-padding">Read More <i aria-hidden="true" class="icon icon-arrow-right pl-2"></i></a>
                            </div>
                        </div>

                    <?php }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php }

// Limit except length to 125 characters.
// tn limited excerpt length by number of characters
function get_excerpt($count)
{
    $permalink = get_permalink($post->ID);
    $excerpt = get_the_content();
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $count);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = '<p>' . $excerpt . '</p>';
    return $excerpt;
}
/* End Project Section Code */



/************************************************************************ OUR PROJECT CUSTOME CODE START **********************************************************************************/

add_shortcode('custom-home-project', 'add_custom_home_project');

function add_custom_home_project()
{ ?>


    <div class="project-container">
        <div class="row">
            <?php
            $post_type_home = 'project';
            $taxonomy_home = 'categories';

            $args_home = [
                'post_type' => $post_type_home,
                'hierarchical' => false,
                "orderby" => "date",
                "order" => "DESC",
                'posts_per_page' => 3
            ];

            $querys_home = new WP_Query($args_home);
            while ($querys_home->have_posts()) {
                $querys_home->the_post();

                $terms_home = get_the_terms($post->ID, $taxonomy_home);
                $categories_proj_home = [];

                foreach ($terms_home as $category_home) {
                    $categories_proj_home = $category_home->slug;
                    $categories_proj_home_name = $category_home->name;
                }

            ?>
                <div class="col-lg-4 col-md-6 col-12 mt-3 pt-3 all <?php echo $category_home->slug; ?>">
                    <div class="">
                        <?php $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'thumbnail'); ?>
                        <a href="<?php the_permalink(); ?>"><img class="img-fluid" src="<?php echo $url ?>" alt=""></a>
                    </div>
                    <div class="bg-white card-box content-info">
                        <?php
                        $categories_proj_home = implode(', ', $categories_proj_home);
                        echo '' . $categories_proj_home_name . ''; ?>
                        <a href="<?php the_permalink(); ?>">
                            <h5 class="pb-2"><?php echo get_the_title(); ?></h5>
                        </a>
                        <p><?php echo get_excerpt(100); ?></p>
                        <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary text-black custom-padding">Read More <i aria-hidden="true" class="icon icon-arrow-right pl-2"></i></a>
                    </div>
                </div>
            <?php }
            wp_reset_postdata();
            ?>
        </div>
    </div>

<?php }



/************************************************************************ OUR PROJECT CUSTOME CODE END **********************************************************************************/

/* Related Post Code */
add_shortcode('related-post', 'add_related_post');
function add_related_post()
{
    $related = get_posts(
        array(
            'category__in' => wp_get_post_categories($post->ID),
            'numberposts' => 3,
            'post_type' => 'project',
            'post__not_in' => array($post->ID)
        )
    );
    $terms_related = get_terms(array(
        'taxonomy' => 'categories',
        'hide_empty' => false
    ));
    foreach ($terms_related as $related_term) {
        $related_cat_related = $related_term->name;
    }
?>
    <div class="related-info-main">
        <?php if ($related) foreach ($related as $related_post) {
            setup_postdata($related_post);
            $char_limit = 100; //character limit
            $content = $related_post->post_content; //contents saved in a variable
        ?>
            <div class="related-detail">
                <?php $url_relate = wp_get_attachment_url(get_post_thumbnail_id($related_post->ID), 'thumbnail'); ?>
                <a href="<?php the_permalink(); ?>"><img class="img-fluid" src="<?php echo $url_relate ?>" alt=""></a>
                <a class="related-category-info" href="<?php the_permalink(); ?>"><?php echo $related_cat_related; ?></a>
                <a class="related-title-info" href="<?php the_permalink() ?>"><?php echo $related_post->post_title; ?></a>
                <p><?php echo substr(strip_tags($content), 0, $char_limit); ?></p>
                <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary text-black custom-padding related-info">Read More <i aria-hidden="true" class="icon icon-arrow-right pl-2"></i></a>
            </div>
        <?php }
        wp_reset_postdata(); ?>
    </div>
<?php }
/* End Related Post Code */




/* Industries Section Code */

add_shortcode('industries', 'add_industries_info');
function add_industries_info()
{ ?>
    <section class="indestries-we">
        <div class="w-100 mb-50">
            <h6 class="mb-10">Industries</h6>
            <div class="slider-header ">
                <h2 class="w-30">We construct </br>commercial spaces </br>across all sectors</h2>
            </div>
        </div>
        <?php
        $args = array(
            'post_status' => 'publish',
            'post_type' => 'carousel',
            'posts_per_page' => -1,
        );
        $loop = new WP_Query($args);
        ?>
        <div class="w-100 slider">
            <div class="owl-carousel owl-theme">
                <?php
                while ($loop->have_posts()) : $loop->the_post();
                ?>
                    <div class="item">
                        <div class="slider-hover">
                            <div class="slider-img mb-50">
                                <?php $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'thumbnail'); ?>
                                <img class="indus-sec-img" src="<?php echo $url ?>" alt="">
                            </div>
                            <div class="slider-content">
                                <a href="<?php the_field('link'); ?>" class="btn btn-1"><?php the_field('button'); ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                                        <path d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z" />
                                    </svg>
                                </a>

                                <h4 class="mb-20"><?php the_title();  ?></h4>
                                <p class="w-70"><?php the_excerpt(); ?></p>
                            </div>
                        </div>
                    </div>
                <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        $('.owl-carousel').owlCarousel({
            loop: false,
            margin: 50,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2,
                    margin: 20
                },
                1000: {
                    items: 2,
                    margin: 20

                },
                1200: {
                    items: 2,
                    // stagePadding: 278
                },
                1400: {
                    items: 3,
                    margin: 40,
                },
                1600: {
                    items: 3,
                },
                1800: {
                    items: 4,
                }
            }
        })
    </script>
<?php }
