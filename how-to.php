<?php
/**
 * howto devloper Page Template
/* The code `if ( ! defined( 'ABSPATH' ) ) { exit; }` is a security measure commonly used in WordPress
themes and plugins. */
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

?>


<?php 



        $query = ContentQuery::get_from_jet([
            'jet_post_type' => 'post_type',
            'jet_category' => 'category_name',
            'jet_limit' => 'posts_per_page',
        ], get_the_ID());



        

?>

