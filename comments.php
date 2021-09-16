<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
 
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
    return;
?>
 
<div id="comments" class="comments-area">
 
    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
                printf( _nx( 'One thought on "%2$s"', '%1$s thoughts on "%2$s"', get_comments_number(), 'comments title', '' ),
                    number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
            ?>
        </h2>
 
        <div class="d-flex mt-4">
        <?php
        // Register Custom Comment Walker
        require_once('class-wp-bootstrap-comment-walker.php');

        wp_list_comments( array(
            'max_depth'         => '',
    'style'             => 'div',
    'callback'          => null,
    'end-callback'      => null,
    'type'              => 'all',
    'page'              => '',
    'per_page'          => '',
    'avatar_size'       => 32,
    'reverse_top_level' => null,
    'reverse_children'  => '',
    'format'            => 'html5', // or 'xhtml' if no 'HTML5' theme support
    'short_ping'        => true,   // @since 3.6
    'echo'              => true ,    // boolean, default is true
            'walker'        => new Bootstrap_Comment_Walker(),
        ) );
    ?>
        </div><!-- .comment-list -->
 
        <?php
            // Are there comments to navigate through?
            if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
        ?>
        <nav class="navigation comment-navigation" role="navigation">
            <h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'twentythirteen' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'twentythirteen' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'twentythirteen' ) ); ?></div>
        </nav><!-- .comment-navigation -->
        <?php endif; // Check for comment navigation ?>
 
        <?php if ( ! comments_open() && get_comments_number() ) : ?>
        <p class="no-comments"><?php _e( 'Comments are closed.' , '' ); ?></p>
        <?php endif; ?>
 
    <?php endif; // have_comments() ?>
    <div class="comment-form">  
                         
    <div class="row clearfix">                    
                        
<?php

//Declare Vars
$comment_send = 'Send';
$comment_reply = 'Leave a Reply';
$comment_reply_to = 'Reply';
 
$comment_author = 'Name';
$comment_email = 'E-Mail';
$comment_body = 'Comment';
$comment_url = 'Website';
$comment_cookies_1 = ' By commenting you accept the';
$comment_cookies_2 = ' Privacy Policy';
 
$comment_before = '<p>Registration isn\'t required.</p>';
 
$comment_cancel = 'Cancel Reply';
 
//Array
$comments_args = array(
    //Define Fields
    'fields' => array(
        //Author field
        'author' => '<div class="mb-3"><input id="author" class="form-control" name="author" aria-required="true" placeholder="' . $comment_author .'"></input></div>',
        //Email Field
        'email' => '<div class="mb-3"><input id="email" class="form-control" name="email" placeholder="' . $comment_email .'"></input></div>',
        //URL Field
        'url' => '<div class="mb-3"><input id="url" class="form-control" name="url" placeholder="' . $comment_url .'"></input></div>',
        //Cookies
        'cookies' => '<input type="checkbox" required>' . $comment_cookies_1 . '<a href="' . get_privacy_policy_url() . '">' . $comment_cookies_2 . '</a>',
    ),
    // Change the title of send button
    'label_submit' => __( $comment_send ),
    // Change the title of the reply section
    'title_reply' => __( $comment_reply ),
    // Change the title of the reply section
    'title_reply_to' => __( $comment_reply_to ),
    //Cancel Reply Text
    'cancel_reply_link' => __( $comment_cancel ),
    // Redefine your own textarea (the comment body).
    'comment_field' => '<div class="mb-3"><textarea id="comment" class="form-control" name="comment" aria-required="true" placeholder="' . $comment_body .'"></textarea></div>',
    //Message Before Comment
    'comment_notes_before' => __( $comment_before),
    // Remove "Text or HTML to be displayed after the set of comment fields".
    'comment_notes_after' => '',
    //Submit Button ID
    'id_submit' => __( 'comment-submit' ),
    'class_submit' => __( 'btn btn-primary mb-3' ),
);
comment_form( $comments_args );
?> </div>
 </div>
</div><!-- #comments -->