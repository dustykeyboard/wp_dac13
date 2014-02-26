<?php get_header(); ?>

<?php
$promotionsDB = new WP_Query(array(
	'post_type' => 'promotion',
	'post_status' => 'publish',
	'posts_per_page' => 4,
	'caller_gets_posts' => 1
));
if($promotionsDB->have_posts()){
	print "<section id='promotions' class='slides'><div id='promo_container' class='size".$promotionsDB->post_count."'>";
	$post_titles = array();
	while($promotionsDB->have_posts()): $promotionsDB->the_post();
		$post_titles[] = get_the_title(); ?>
	<article id='promo-<?php the_ID(); ?>'>
		<a title='<?php the_title_attribute(); ?>' href='<?= get_post_meta($post->ID, 'promotion_link', true); ?>'><?php the_post_thumbnail( 'promotion' ); ?></a>
	</article>
	<?php
	endwhile;
	if(count($post_titles)>1){
	print "</div><div id='slidernav'>";
		foreach($post_titles as $i=>$title){
			print "<a onclick='document.getElementById(\"promo_container\").style.left=\"-".($i * 100)."%\";'>$title</a>";
		}
	}
	print "</div></section>";
}

$posts_per_page = 12;
$number_of_features = 0;

$sermon_category = 41;
$sermon_categories = get_categories(array('child_of'=>$sermon_category));

$excluded_categories = array($sermon_category);
foreach ($sermon_categories as $c) {
	$excluded_categories[] = $c->cat_ID;
}

$frontpage = new WP_Query(array(
	'posts_per_page' => $posts_per_page,
	'category__not_in' => $excluded_categories
));

$i = 0;
print "<section id='features'>";
while ( $frontpage->have_posts() ) : $frontpage->the_post();
	if($i < $number_of_features){ ?>
	<article id='post-<?php the_ID(); ?>'>
		<a rel='permalink' href='<?php the_permalink(); ?>' title='<?php the_title_attribute(); ?>'><?php the_post_thumbnail( 'feature' ); ?><span class='title'><?php the_title_attribute(); ?></span></a>
	</article>
	<?php
	}else if($i < $posts_per_page){
		if($i == $number_of_features){
			print "</section><section id='latest' data-label='Latest Content'>";
		}
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title"><a rel='permalink' href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h2>
			<a href='<?php the_permalink(); ?>'><?= (has_post_thumbnail() ? the_post_thumbnail('tiny', array('class'=>'latest-thumbnail', 'title'=>get_the_title(), 'alt'=>get_the_title())) : get_post_format() == 'audio' ? '<img src="'.get_template_directory_uri().'/podcast_icon.png" class="latest-thumbnail" />' : ''); ?></a>

			<div class="entry-content">
			<?php the_excerpt(); ?>
			</div>
		</article>
	<?php
	}
	$i++;
endwhile; // end of the loop. ?>
<div class='clear'></div>
</section>
	
<?php get_footer(); ?>