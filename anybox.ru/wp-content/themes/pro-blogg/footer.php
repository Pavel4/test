<?php $options = get_option( 'dess_settings' ); ?>		
		<footer id="foot">
			<div class="main-foot">
				<div class="container">
					<div class="foot-col">
						<?php dynamic_sidebar('footer-1'); ?>
					</div>
					<div class="foot-col">
						<?php dynamic_sidebar('footer-2'); ?>
					</div>
					<div class="foot-col">
						<?php dynamic_sidebar('footer-3'); ?>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="bottom-foot">
				<div class="container">
					<p class="credits"><?php echo (dess_options('copyright') !='' ? dess_options('copyright') : '2015 Copyright. Powered by Wordpress'); ?></p>
				</div>
			</div>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>