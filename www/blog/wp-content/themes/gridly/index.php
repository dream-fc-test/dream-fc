<?php get_header(); ?>


<?php if (have_posts()) : ?>
<div id="post-area">
<?php while (have_posts()) : the_post(); ?>	
<?php if (in_category('スケジュール')) continue; ?>
   		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="gridly-copy"><h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
		 <?php if ( has_post_thumbnail() ) { ?>
         <div class="gridly-image"><a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'summary-image' );  ?></a></div>
         
       
		  <?php } ?>
       			
                <p class="gridly-date"><?php the_time(get_option('date_format')); ?></p>

<?php the_excerpt(); ?> 

               <p class="gridly-link"><a href="<?php the_permalink() ?>">続きを読む&rarr;</a></p>
         </div>
       </div>
       
       

<?php endwhile; ?>
</div>
<?php else : ?>
<?php endif; ?>
    
<?php next_posts_link('<p class="view-older">View Older Entries</p>') ?>
    
 
<?php get_footer(); ?>