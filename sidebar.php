<?php
/**
 * Sidebar Template.
 */

if ( is_active_sidebar( 'primary_widget_area' ) || is_archive() || is_single() ) :
?>
<div id="sidebar" class=" order-md-first col-sm-12 oder-sm-last ">
	<?php
		if ( is_active_sidebar( 'primary_widget_area' ) ) :
	?>
	
			<?php
				dynamic_sidebar( 'primary_widget_area' );

				if ( current_user_can( 'manage_options' ) ) :
			?>
					<?php
				endif;
			?>
		
	<?php
		endif;

	//	if ( is_archive() || is_single() ) :
	?>
		<div class="sidebar-popular-post sidebar-grid shadow mb-50">
        <div class="card mb-4  ">
				<?php
                 $output ='<div class="card-header">' . esc_html__( 'Recent Posts', 'as' ) . '</div>';
                
						$recentposts_query = new WP_Query( 'posts_per_page=5' ); // Max. 5 posts in Sidebar!
						$month_check = null;
						
						if ( $recentposts_query->have_posts() ) :
                           
						
							while ( $recentposts_query->have_posts() ) :
								$recentposts_query->the_post();
								$featured_img_offer_url = get_the_post_thumbnail_url(get_the_ID(),'thumbnail');
								$output .= ' <div class="single-post mb-20">';
								$output .= '<div class="post-image">
								<a href="#"><img src="'.$featured_img_offer_url.'" alt="post image"></a>
							</div>';
							$output .= '<div class="post-desc">
							<div class="post-title">
								<h5 class="margin-0"><a href="' . esc_url( get_the_permalink() ) . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'as' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">' . apply_filters( 'the_title', get_the_title() ) . ' </a></h5>
							</div>
							<ul>
								<li><i class="fa fa-calendar"></i>';
								$month='';
								$month = get_the_date( 'F, Y' );
									
										$output .= '<a href="' . esc_url( get_month_link( get_the_date( 'Y' ), get_the_date( 'm' ) ) ) . '" title="' . esc_attr( get_the_date( 'F, Y' ) ) . '">' . esc_html( $month ) . '</a>';
								
									$month_check = $month;
								$output .= '</li>
							</ul>
						</div>';
						$output .= '</div>';
							endwhile;
						endif;
						wp_reset_postdata();
				

					echo $output;
				?>
				</div>
				</div>
                <div class="card mb-4">
                <div class="card-header"><?php esc_html_e( 'Categories', 'as' ); ?></div>
                <div class="card-body">
				<ul class="categories">
					
					<?php
						wp_list_categories( '&title_li=' );

						if ( ! is_author() ) :
					?>
							
							
					<?php
						endif;
					?>
                    
				</ul>
                </div>
			</div><!-- /#primary-two -->
		
	<?php
		//endif;
	?>
</div><!-- /#sidebar -->
<?php
	endif;
?>
