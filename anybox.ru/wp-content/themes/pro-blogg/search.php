<?php
get_header();
?>
<div class="content">
	<div class="container">
		<div class="post_content">
			<div class="archive_title">
				<h2><?php echo single_cat_title( '', false ); ?></h2>
			</div><!--//archive_title-->
			<div class="home_posts">
				<?php
					$args = array_merge( $wp_query->query, array( 'posts_per_page' => 6 ) );
					query_posts($args);
					if ( have_posts() ) :
						while ( have_posts() ) : the_post();
							echo '<div class="grid_post">
									<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
							$type = get_post_meta($post->ID,'page_featured_type',true);
				 			switch ($type) {
				 				case 'youtube':
				 					echo '<iframe width="560" height="315" src="http://www.youtube.com/embed/'.get_post_meta( get_the_ID(), 'page_video_id', true ).'?wmode=transparent" frameborder="0" allowfullscreen></iframe>';
				 					break;
				 				case 'vimeo':
				 					echo '<iframe src="http://player.vimeo.com/video/'.get_post_meta( get_the_ID(), 'page_video_id', true ).'?title=0&amp;byline=0&amp;portrait=0&amp;color=03b3fc" width="500" height="338" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
				 					break;
				 				default:
									echo '<div class="grid_post_img">
												<a href="'.get_permalink().'">'.get_the_post_thumbnail().'</a>
											</div>';
									break;
							}
							echo '<div class="grid_home_posts">
										<p>'.dess_get_excerpt(120).'</p>
									</div>
								</div>
								';
						endwhile;
						
				?>
		</div>
		<?php
			echo '<div class="load_more_content"><div class="load_more_text">';
					ob_start();
						next_posts_link('LOAD MORE');
						$buffer = ob_get_contents();
					ob_end_clean();
					if(!empty($buffer)) echo $buffer;
				echo'</div></div>';					
				$max_pages = $wp_query->max_num_pages;
				wp_reset_postdata();
			endif;
		?>
		</div>
		<?php get_sidebar(); ?>
		<div class="clear"></div>
	</div>
</div>
<script type="text/javascript">
		jQuery(document).ready(function($){
		var container = $('.home_posts');
		function grid_images(){
			$('.grid_post_img').each(function(){
				var h = $(this).find('img').height();
				var w = $(this).parent('.grid_post').width();
				$(this).css({'width':w, 'height':h})
			});
		}
		container.imagesLoaded( function() {
			$('.home_posts').masonry({
			  itemSelector: '.grid_post',
			  columnWidth: '.home_posts .grid_post',
			  gutter: 30
			});
			grid_images();
		});
		var curPage = 1;
		var pagesNum = <?php echo $max_pages ?>;
		
		if(pagesNum == 1){
			$('.load_more_text a').css('display','none');	
		}
		  $('.home_posts').infinitescroll({
		    navSelector  : "div.load_more_text",            
		    nextSelector : "div.load_more_text a:first",    
		    itemSelector : ".home_posts .grid_post",
		    maxPage: pagesNum
		  },function(arrayOfNewElems){
		  	container.imagesLoaded( function() {
	           container.masonry( 'appended', arrayOfNewElems ); 
	           grid_images();		 
	        });
		  	
	        curPage++;
	        $('.load_more_text').show();
	        if(curPage == pagesNum) {
	            $('.load_more_text a').remove();
	        }
		  });
		  $('.home_posts').infinitescroll('unbind');
		  $('.load_more_text a').on('click', function(e) {
			  e.preventDefault();
			  $('.home_posts').infinitescroll('retrieve');
			});
		  $(window).resize(function(){
		  	grid_images();
		  })
		 
		});
	</script>
<?php
get_footer();
?>