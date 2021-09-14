<?php
/**
 * Sidebar Template.
 */

if ( is_active_sidebar( 'primary_widget_area' ) || is_archive() || is_single() ) :
?>
<div id="sidebar" class=" order-md-first col-sm-12 oder-sm-last">
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

		if ( is_archive() || is_single() ) :
	?>
		
        <div class="card mb-4">
				<?php
                 $output ='<div class="card-header">' . esc_html__( 'Recent Posts', 'as' ) . '</div>';
                 $output .= ' <div class="card-body"><ul class="recentposts">';
						$recentposts_query = new WP_Query( 'posts_per_page=5' ); // Max. 5 posts in Sidebar!
						$month_check = null;
						if ( $recentposts_query->have_posts() ) :
                           
						
							while ( $recentposts_query->have_posts() ) :
								$recentposts_query->the_post();
								$output .= '<li>';
									// Show monthly archive and link to months.
									$month = get_the_date( 'F, Y' );
									if ( $month !== $month_check ) :
										$output .= '<a href="' . esc_url( get_month_link( get_the_date( 'Y' ), get_the_date( 'm' ) ) ) . '" title="' . esc_attr( get_the_date( 'F, Y' ) ) . '">' . esc_html( $month ) . '</a>';
									endif;
									$month_check = $month;

								$output .= '<h4><a href="' . esc_url( get_the_permalink() ) . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'as' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">' . apply_filters( 'the_title', get_the_title() ) . '</a></h4>';
								$output .= '</li>';
							endwhile;
						endif;
						wp_reset_postdata();
					$output .= '</ul></div>';

					echo $output;
				?>
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
		endif;
	?>
</div><!-- /#sidebar -->
<?php
	endif;
?>
