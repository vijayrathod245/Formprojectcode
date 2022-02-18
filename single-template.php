<?php
/*
 * Template Name: Single Template
 * Template Post Type: project
 */
  
get_header(); ?>

<div class="slick-master">
<?php
// Use below code to show metabox values from anywhere
$id = get_the_ID();
	$banner_img = get_post_meta($id, 'post_banner_img', true);	
	$banner_img = explode(',', $banner_img);
	if(!empty($banner_img)) {
      foreach ($banner_img as $attachment_id) { ?>
    <div> 
    <?php $url_img = wp_get_attachment_url($attachment_id, 'thumbnail'); ?>
    <img src="<?php echo $url_img ?>" alt="" srcset="" >
  
    </div>

    <?php 
      }
  } 
?>
</div>

  <div class="collaps">
    <div class="title">
	<?php
  

		while ( have_posts() ) : the_post(); 
           // $char_limit_post_content = 200; //character limit
          //  echo $content_post->post_content; //contents saved in a variabl

          $terms_category_single = get_the_terms( $post->ID , 'categories' ); 
          foreach ( $terms_category_single as $term_cat_list ){
                $cat_list_name = $term_cat_list->name;
          }
          //echo '<pre>';
          //print_r($terms23);die;

  ?>
<span class="category"><?php echo $cat_list_name; ?></span>


	  
      <h3 class="toggle">
        <?php echo get_the_title(); ?>
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="10.409" viewBox="0 0 18 10.409">
          <path
            d="M224.6,203.282l6.668-6.874a1.4,1.4,0,0,1,1.893-.084,1.2,1.2,0,0,1,.09,1.775l-7.66,7.9a1.4,1.4,0,0,1-1.984,0l-7.66-7.9a1.2,1.2,0,0,1,.09-1.775,1.4,1.4,0,0,1,1.894.084Z"
            transform="translate(-215.601 -195.996)" />
        </svg>
      </h3>

      <div id="target">
        <p><strong><?php //echo get_the_title(); ?></strong></p>
        <p><?php the_content(); ?></p>
      </div>
	  
	  <?php // End of the loop.
		endwhile; 
		wp_reset_postdata();
		?>
    </div>
  </div> 
  <?php
  
  $related = get_posts(
        array(
            'category__in' => wp_get_post_categories($post->ID),
            'numberposts' => 3,
            'post_type' => 'project',
            'post__not_in' => array($post->ID)
        )
    );
    $terms_related = get_terms( array(
      'taxonomy' => 'categories',
      'hide_empty' => false
    ) );
    foreach ( $terms_related as $related_term ) {
      $related_cat_related = $related_term->name;
    }
   // echo '<pre>';
   // print_r($related);die;
    ?>
<div class="related-title-item-info">
        <h2>You Might Also Like</h2>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
    </div>
    
    
    <?php echo do_shortcode('[related-post]'); ?>
   
<?php //} ?>

<?php get_footer(); ?>