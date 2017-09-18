	

<?php if ( is_active_sidebar( 'gridly_footer')) { ?>     
   <div id="footer-area">
			<?php dynamic_sidebar( 'gridly_footer' ); ?>
        </div><!-- // footer area -->   
  <?php }  ?>   
      


 <div id="copyright">
 <p>Copyright&copy; <?php echo date("Y"); echo " "; bloginfo('name'); ?> All Rights Reserved.</p>
 </div><!-- // copyright -->   
     
</div><!-- // wrap -->   

	<?php wp_footer(); ?>
</body>
</html>