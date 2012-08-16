<?php
/*
  Template Name: PrintAll
*/
?>

<?php get_header(); ?>

<?php


function listPages($parent_id)
{
    $args = array(
        'post_type' => array( 'page' ),
        'post_status' => array( 'publish' ),
        'orderby' => 'menu_order',
        'order' => 'asc',
        'post_parent' => $parent_id,
        'posts_per_page' => 900,
        'post__not_in' => array( get_the_ID() )
        );
    query_posts( $args );

    $args=array('child_of' => $parent_id, 'parent' => $parent_id, 'sort_column'=>'menu_order', 'exclude'=>get_the_ID());
    $pages = get_pages($args);

    if ($pages)
    {

        foreach ($pages as $page)
        {
            echo '<div class="page" style="margin-bottom:40px;" >';
            echo '    <div class="page-header">';
            echo '        <h1 class="postTitle">'.$page->post_title.'</h1>';
            echo '    </div>';
            echo '    <div class="" >';
            echo $page->post_content;
            echo '    </div>';
            echo '</div>';

            listPages($page->ID);
        }


    }

} ?>

<?php
echo '<div id="content" class="'.CONTAINER_CLASSES.'">';
echo '    <div id="main" class="'.MAIN_CLASSES.'" role="main">';
?>

<?php listPages(0); ?>

<?php
echo '    </div>';
echo '</div>';
?>

<?php get_footer(); ?>
