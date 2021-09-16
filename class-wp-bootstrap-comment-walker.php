<?php
 /*
 * Plugin Name: WP Bootstrap Comment Walker
 * Plugin URI:  https://github.com/wp-bootstrap/wp-bootstrap-comment-walker
 * Version: 2.0.5
 * Description: A WordPress class to format WordPress Comments to Twitter Bootstrap.
 * Author: WP-Bootstrap
 * Author URI: https://github.com/wp-bootstrap
 * GitHub Plugin URI: https://github.com/wp-bootstrap/wp-bootstrap-comment-walker
 * GitHub Branch: master
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
*/

class Bootstrap_Comment_Walker extends Walker_Comment {
	/**
   * Output a comment in the HTML5 format.
   *
   * @access protected
   * @since 1.0.0
   *
   * @see wp_list_comments()
   *
   * @param object $comment Comment to display.
   * @param int    $depth   Depth of comment.
   * @param array  $args    An array of arguments.
   */
  protected function html5_comment($comment, $depth, $args)
  {
    $icon_svg_reply = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-reply" viewBox="0 0 16 16">
									<path d="M6.598 5.013a.144.144 0 0 1 .202.134V6.3a.5.5 0 0 0 .5.5c.667 0 2.013.005 3.3.822.984.624 1.99 1.76 2.595 3.876-1.02-.983-2.185-1.516-3.205-1.799a8.74 8.74 0 0 0-1.921-.306 7.404 7.404 0 0 0-.798.008h-.013l-.005.001h-.001L7.3 9.9l-.05-.498a.5.5 0 0 0-.45.498v1.153c0 .108-.11.176-.202.134L2.614 8.254a.503.503 0 0 0-.042-.028.147.147 0 0 1 0-.252.499.499 0 0 0 .042-.028l3.984-2.933zM7.8 10.386c.068 0 .143.003.223.006.434.02 1.034.086 1.7.271 1.326.368 2.896 1.202 3.94 3.08a.5.5 0 0 0 .933-.305c-.464-3.71-1.886-5.662-3.46-6.66-1.245-.79-2.527-.942-3.336-.971v-.66a1.144 1.144 0 0 0-1.767-.96l-3.994 2.94a1.147 1.147 0 0 0 0 1.946l3.994 2.94a1.144 1.144 0 0 0 1.767-.96v-.667z"></path>
								</svg>';
    $tag = ('div' === $args['style']) ? 'div' : 'li';
?>
    <?php
    $col_total = 12;
    $col_rem =  $depth == 1 ? ($col_total) : ($col_total - $depth);
    $col_rem =  $depth == 1 ? ($col_total) : ($col_total - 1);

    $class_comment =  $depth == 1 ? ' ' : ' comment_reply ';
    // echo $depth; 
    echo '<div class="col-' . $col_rem . '">';
    echo '<div class="row justify-content-end">';
    ?>
    <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class($this->has_children ? 'parent comment border-secondary mb-2 mb-md-3 p-3' . $class_comment : 'comment border-secondary mb-2 mb-md-3 p-3' . $class_comment); ?>>

      <?php if (0 != $args['avatar_size']) : ?>
        <div class="d-flex flex-row">
          <?php
          if (get_comment_author() == get_comment_author_link()) {
          ?>
            <a href="<?php echo get_comment_author_url(); ?>" class="user-image me-2 me-md-3">
              <img src="<?php print get_avatar_url($comment->user_id, ['size' => '40']); ?>" class="rounded-circle" />
              <?php
              // echo get_avatar($comment, $args['avatar_size']);
              ?>
            </a>
          <?php
          } else {
          ?>
            <div href="<?php echo get_comment_author_url(); ?>" class="user-image me-2 me-md-3">
              <img src="<?php print get_avatar_url($comment->user_id, ['size' => '40']); ?>" class="rounded-circle" />
              <?php
              // echo get_avatar($comment, $args['avatar_size']);
              ?>
            </div>
          <?php
          }
          ?>
          <div class="meta d-flex flex-column w-100">

            <div class="d-flex justify-content-between">
              <div>
                <?php
                if (get_comment_author() == get_comment_author_link()) {
                ?>
                  <a class="text-primary fw-bold mb-0" href="<?php comment_author_url(); ?>">Visit <?php comment_author(); ?>'s site</a>
                <?php
                } else {
                ?>
                  <h6 class="text-primary fw-bold mb-0"><?php comment_author(); ?></h6>
                <?php
                }
                ?>

,<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php printf( _x( '%1$s at %2$s', '1: date, 2: time' ), get_comment_date(), get_comment_time() ); ?>
						</time>
					</a>
              </div>
              <div>
                <a class="comment_link text-decoration-none text-light" href="<?php echo esc_url(get_comment_link($comment->comment_ID, $args)); ?>">
                  <time class="date small" datetime="<?php comment_time('c'); ?>">
                    <?php printf(_x('%1$s at %2$s', '1: date, 2: time'), get_comment_date(), get_comment_time()); ?>
                  </time>
                </a>
              </div>
            </div>

            <hr class="my-1 bg-secondary" />

            <div class="comment-body mt-1 mt-md-2" id="div-comment-<?php comment_ID(); ?>">

              <?php if ('0' == $comment->comment_approved) : ?>
                <p class="comment-awaiting-moderation label label-info"><?php _e('Your comment is awaiting moderation.'); ?></p>
              <?php endif; ?>

              <div class="content">
                <?php comment_text(); ?>
              </div><!-- .content mb-0 mt-2 mt-md-3 -->

            </div>

            <div class="d-flex justify-content-between">

              <?php
              comment_reply_link(array_merge($args, array(
                'reply_text' => __('Reply ' . $icon_svg_reply . '', 'textdomain'),
                'add_below' => 'div-comment',
                'depth'     => $depth,
                'max_depth' => $args['max_depth'],
                // 'before'    => '<div class="reply">',
                // 'after'     => '</div>'
              )));
              ?>

              <?php edit_comment_link(__('Edit '), '<div class="edit-link ms-2">', '</div>'); ?>

            </div>
          </div>
        </div>
      <?php endif; ?>

      <?php
      echo '</row>'; // End row
      echo '</div>'; // End col-md-12
      ?>
  <?php
  }
}