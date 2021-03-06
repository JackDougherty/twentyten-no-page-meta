<?php
// twentyten child theme smaller header image modified by Jack Dougherty, Trinity College
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'twentyten_header_image_width', 940 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'twentyten_header_image_height', 100 ) );

if ( ! function_exists( 'twentyten_posted_on' ) ) :
/**
 * Integrate Co-Authors Plus with TwentyTen by replacing twentyten_posted_on() with this function
 */
function twentyten_posted_on() {
    if ( function_exists( 'coauthors_posts_links' ) ) :
        printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'twentyten' ),
            'meta-prep meta-prep-author',
            sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
                get_permalink(),
                esc_attr( get_the_time() ),
                get_the_date()
            ),
            coauthors_posts_links( null, null, null, null, false )
        );
    else:
        printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'twentyten' ),
            'meta-prep meta-prep-author',
            sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
                get_permalink(),
                esc_attr( get_the_time() ),
                get_the_date()
            ),
            sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
                get_author_posts_url( get_the_author_meta( 'ID' ) ),
                esc_attr( sprintf( __( 'View all posts by %s', 'twentyten' ), get_the_author() ) ),
                get_the_author()
            )
        );
    endif;
}
endif;

//Jack added make_clickable function to automatically transform all links outside of shortcodes, based on http://blog.robbychen.com/wordpress-make_clickable/
function mc_ignore_shortcode($content) {
    $content = do_shortcode($content);
    return make_clickable($content);
}
 
add_filter( 'the_content', 'mc_ignore_shortcode' );
?>
