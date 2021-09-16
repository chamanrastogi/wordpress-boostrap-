<?php


get_header(); ?>


<div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
                    $featured_img_offer_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
                    ?>
                    <!-- Post content-->
                    <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1"><?php the_title(); ?></h1>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2">Posted on <?php the_time('F jS, Y'); ?> by <?php the_author_posts_link(); ?></div>
                            <!-- Post categories-->
                            <?php
                            $categories = get_the_category();
                            foreach($categories as $category){
                               // echo $category->name; //category name
                                $cat_link = get_category_link($category->cat_ID);
                                echo '<a class="badge bg-secondary text-decoration-none link-light" href="'.$cat_link.'"> '.$category->name.' </a> ' ; // category link
                             }
                            ?>
                   
                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4"><img class="img-fluid rounded" src="<?=$featured_img_offer_url?>" alt="..."></figure>
                        <!-- Post content-->
                        <section class="mb-5">
                            <p class="fs-5 mb-4"><?php the_content(); ?></p>
                                    </section>
                    </article>
                    <?php endwhile; else : ?>
	                <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
                    <?php endif; ?>
                    <!-- Comments section-->
                    <section class="mb-5">
                        <div class="card bg-light">
                            <div class="card-body">
                                <!-- Comment form-->
                                
                            
                                <?php
                                comments_template();
                                ?>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- Side widgets-->
                <div class="col-lg-4">
                
    <?php get_sidebar(); ?>

                </div>
            </div>
        </div>

<?php get_footer(); ?>