<?php
get_header();
?>
<div class="content">
	<div class="container">
		<div class="post_content">
			<?php if(have_posts()): the_post(); ?>
			<article class="post_box" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="post_nav">
					<span class="prev_post">
						<?php  previous_post_link('%link', '') ?>
					</span>
					<span class="next_post">
						<?php  next_post_link('%link', '') ?>
					</span>
				</div>
				<div class="clear"></div>
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
				 <?php the_tags( '<div class="post_tags">Tags: ', ', ', '</div>' ); ?> 
			</article>
			<div class="clear"></div>
			<?php if ( comments_open() || '0' != get_comments_number() ) : ?>
						<div class="home_blog_box">
							<div class="comments_cont">
							<?php
								// If comments are open or we have at least one comment, load up the comment template
								comments_template( '', true );
							?>
							</div>
						</div>
			<?php endif;
			endif;
			?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php
get_footer();
?>