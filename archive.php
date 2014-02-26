<?php get_header(); ?>

<section id='latest'>
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if(get_post_format() == 'audio'){ ?>
			<h2 class="entry-title"><a rel='permalink' href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h2>
			<a href='<?php the_permalink(); ?>'><?= (has_post_thumbnail() ? the_post_thumbnail('tiny', array('class'=>'latest-thumbnail', 'title'=>get_the_title(), 'alt'=>get_the_title())) : get_post_format() == 'audio' ? '<img src="'.get_template_directory_uri().'/podcast_icon.png" class="latest-thumbnail" />' : ''); ?></a>
			<?php }else{ ?>
			<a href='<?php the_permalink(); ?>'><?= (has_post_thumbnail() ? the_post_thumbnail(array(480,240), array('class'=>'latest-thumbnail', 'title'=>get_the_title(), 'alt'=>get_the_title())) : get_post_format() == 'audio' ? '<img src="'.get_template_directory_uri().'/podcast_icon.png" class="latest-thumbnail" />' : ''); ?></a>
			<h2 class="entry-title"><a rel='permalink' href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h2>
			<?php } ?>

			<div class="entry-content">
			<?php the_excerpt(); ?>
			</div>
		</article>
	<?php endwhile; // end of the loop. ?>
	
	<div id='pagination'><?php posts_nav_link( $sep, $prelabel, $nextlabel ); ?></div>
</section>
	
<?php get_footer(); ?>