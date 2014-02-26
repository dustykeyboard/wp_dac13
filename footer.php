		<footer>
		
		<?php if ( is_active_sidebar( 'footer_sidebar' ) ) : ?>
		<?php dynamic_sidebar( 'footer_sidebar' ); ?>
		<?php else: ?>
			Join us at <a href='http://192.168.0.8/~phil/wordpress/?page_id=3107'>Dapto Anglican Church</a>, we meet weekly in three locations. Connect online on <a href='http://twitter.com/intent/user?screen_name=daptoanglican'>Twitter</a>, <a href='http://www.facebook.com/daptoanglican/'>Facebook</a> or <a href='<?php bloginfo('url'); ?>?feed=rss2'>RSS</a>. Grab a coffee at <a href='http://twitter.com/intent/user?screen_name=daptocafe'>The Café</a>, right outside <a href='http://stlukespreschool.org.au'>St Luke's Preschool</a>.
		<?php endif; ?>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>