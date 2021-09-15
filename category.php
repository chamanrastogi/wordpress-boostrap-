<?php


get_header(); ?>


<!-- Page header with logo and tagline-->
<header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder"><?php single_cat_title(  ); ?></h1>
                    
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                    <!-- Featured blog post-->
                 
                    <!-- Nested row for non-featured blog posts-->
                    <div class="row">
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
                    $featured_img_offer_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
                    ?>
                        <div class="col-lg-12">
                            <!-- Blog post-->
                            <div class="card mb-4">
                                <a href="<?php the_permalink(); ?>"><img class="card-img-top" src="<?=$featured_img_offer_url?>" alt="..." /></a>
                                <div class="card-body">
                                    <div class="small text-muted"><?php the_time('F jS, Y'); ?></div>
                                    <h2 class="card-title h4"><?php the_title(); ?></h2>
                                    <p class="card-text"><?php echo wp_trim_words( get_the_content(), 40, '...' ); ?></p>
                                    <a class="btn btn-primary" href="<?php the_permalink(); ?>">Read more →</a>
                                </div>
                            </div>
                            <!-- Blog post-->
                           
                        </div>
                        <?php endwhile; else : ?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
                    </div>
                    <!-- Pagination-->
                    <nav aria-label="Pagination">
                        <hr class="my-0" />
                        <ul class="pagination justify-content-center my-4">
                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Newer</a></li>
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
                            <li class="page-item"><a class="page-link" href="#!">2</a></li>
                            <li class="page-item"><a class="page-link" href="#!">3</a></li>
                            <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                            <li class="page-item"><a class="page-link" href="#!">15</a></li>
                            <li class="page-item"><a class="page-link" href="#!">Older</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- Side widgets-->
                <div class="col-lg-4">
                
    <?php get_sidebar(); ?>

                </div>
            </div>
        </div>

<?php get_footer(); ?>