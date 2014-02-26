<?php get_header(); ?>

<section id='single'>
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?= has_post_thumbnail() ? the_post_thumbnail( 'full', array('class'=>'single-thumbnail', 'title'=>get_the_title(), 'alt'=>get_the_title())) : ''; ?>
			<h2 class="entry-title"><a rel='permalink' href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h2>

			<div class="entry-content">
			<?php the_content(); ?>
			</div>
			<?php
				$children =& get_children(array(
					'post_parent' => get_the_ID(),
					'post_type'=>'page'
				));
				if(!empty($children)){
			?>
				<ul class="entry-children">
				<?php foreach($children as $child_id => $child ) { ?>
					<li><a href='<?= $child->guid; ?>'><?= $child->post_title; ?></a></li>
						
				<?php } ?>
				</ul>
			<?php } ?>
				<?php if(is_single()){ ?>
				<div class="entry-meta">
				<?php edit_post_link( 'Edit', '<span class="edit-link">', '</span> &bull; ' ); ?>
					
					<?php the_date(); ?>
					&bull;
					<?php the_category(' &raquo; ', 'single'); ?>
				</div>
				<?php }else{ ?>
					<?php edit_post_link( 'Edit', '<div class="entry-meta"><span class="edit-link">', '</span> &bull; '.get_the_date().'</div>' ); ?>
				<?php } ?>
		</article>

		<?php if ( is_active_sidebar( 'page_and_single' ) ) : ?>
		<ul id="sidebar">
			<?php dynamic_sidebar( 'page_and_single' ); ?>
		</ul>
		<?php endif; ?>
	<?php endwhile; // end of the loop. ?>
</section>
	
<?php get_footer(); ?>