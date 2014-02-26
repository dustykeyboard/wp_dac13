<?php get_header(); ?>

<?php if(is_home()){

	$promotionsDB = new WP_Query(array(
		'post_type' => 'promotion',
		'post_status' => 'publish',
		'posts_per_page' => 4,
		'caller_gets_posts' => 1
	));
	if($promotionsDB->have_posts()){
		print "<section id='promotions' class='slides'><div id='promo_container' class='size".$promotionsDB->post_count."'>";
		while($promotionsDB->have_posts()): $promotionsDB->the_post(); ?>
		<article id='promo-<?php the_ID(); ?>'>
			<a title='<?php the_title_attribute(); ?>' href='<?= get_post_meta($post->ID, 'promotion_link', true); ?>'><?php the_post_thumbnail( array(960, 360) ); ?></a>
		</article>
		<?php
		endwhile;
		print "</div><div id='slidernav'>";
		for($i = 0; $i < count($promotionsDB->posts); $i++){
			print "<a onclick='document.getElementById(\"promo_container\").style.left=\"-".($i * 100)."%\";'>&bull;</a>";
		}
		print "</div></section>";
	}

	$featuresDB = new WP_Query(array(
		'post__in' => get_option('sticky_posts'),
		'caller_gets_posts' => 1,
		'posts_per_page' => 4
	));
	if($featuresDB->have_posts()){
		print "<section id='features'>";
		while($featuresDB->have_posts()): $featuresDB->the_post(); ?>
		<article id='post-<?php the_ID(); ?>'>
			<a rel='permalink' href='<?php the_permalink(); ?>' title='<?php the_title_attribute(); ?>'><?php the_post_thumbnail( array(480, 240) ); ?></a>
		</article>
		<?php
		endwhile;
		print "</section>";
	}

	query_posts(array(
		'ignore_sticky_posts'=>1,
		'posts_per_page'=>12
	));
?>
		<section id='latest' data-label='Latest Content'>
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h2 class="entry-title"><a rel='permalink' href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h2>
					<a href='<?php the_permalink(); ?>'><?= (has_post_thumbnail() ? the_post_thumbnail(array(75,75), array('class'=>'latest-thumbnail', 'title'=>get_the_title(), 'alt'=>get_the_title())) : get_post_format() == 'audio' ? '<img src="'.get_template_directory_uri().'/podcast_icon.png" class="latest-thumbnail" />' : ''); ?></a>

					<div class="entry-content">
					<?php the_excerpt(); ?>
					</div>
				</article>
			<?php endwhile; // end of the loop. ?>
		</section>
<?php }else if(is_single() or is_page()){ ?>
		<section id='single'>
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?= has_post_thumbnail() ? the_post_thumbnail(array(600,600), array('class'=>'single-thumbnail', 'title'=>get_the_title(), 'alt'=>get_the_title())) : ''; ?>
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
			<?php endwhile; // end of the loop. ?>
		</section>
<?php }else{ ?>
		<section id='latest'>
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h2 class="entry-title"><a rel='permalink' href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h2>
					<a href='<?php the_permalink(); ?>'><?= (has_post_thumbnail() ? the_post_thumbnail() : (get_post_format() == 'audio' ? '<img src="'.get_template_directory_uri().'/podcast_icon.png" class="latest-thumbnail" />' : '')); ?></a>

					<div class="entry-content">
					<?php the_excerpt(); ?>
					</div>
				</article>
			<?php endwhile; // end of the loop. ?>
			
			<div id='pagination'><?php posts_nav_link( $sep, $prelabel, $nextlabel ); ?></div>
		</section>
<?php } ?>
	
<?php get_footer(); ?>