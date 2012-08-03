<?php
/*
  Template Name: PrintAll
*/
?>

<?php get_header(); ?>

<?php

$args = array(
    'post_type' => array( 'page' ),
    'post_status' => array( 'publish' ),
    'orderby' => 'parent',
    'order' => 'asc',
    'posts_per_page' => 900,
    'post__not_in' => array( get_the_ID() )
    );
query_posts( $args );
?>

<div id="content" class="<?php echo CONTAINER_CLASSES; ?>">

    <div id="main" class="<?php echo MAIN_CLASSES; ?>" role="main">

        <? if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div class="page" style="margin-bottom:40px;" >
            <div class="page-header">
                <h1 class="postTitle"><?php the_title(); ?></h1>
            </div>
            <div class="" >
                <?php the_content(__('(more...)')); ?>
            </div>
        </div>

        <?php endwhile; else: ?>

        <p>Sorry, no pages matched your criteria.</p>

        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>
