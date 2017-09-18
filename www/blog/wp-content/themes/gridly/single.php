<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
           
       
   		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			                  

       			<div class="gridly-copy">
                <h1><?php the_title(); ?></h1>
                 <p class="gridly-date"> <?php the_time(get_option('date_format')); ?></p>
           		
                
<?php if ( has_post_thumbnail() ) { ?>			
				<div class="gridly-image"><?php the_post_thumbnail( 'detail-image' );  ?></div>
                
             <?php } ?> 
                 <?php the_content(); ?> 
                <div class="clear"></div>
				
                </div>


                
                
       </div>
       
		<?php endwhile; endif; ?>
       
       <div class="post-nav">
               <div class="post-prev"><?php previous_post_link('%link'); ?> </div>
			   <div class="post-next"><?php next_post_link('%link'); ?></div>
        </div>      
   
       
       
       
  
 

<?php get_footer(); ?>