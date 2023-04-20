<?php if ( get_the_author_meta( 'description' ) ) { ?>
	<div id="myarcadetheme-author-info">

		<?php echo get_avatar( get_the_author_meta( 'ID' ), 85 ); ?>

		<div id="myarcadetheme-author-meta">

			<div id="myarcadetheme-author-details">
		
				<div id="myarcadetheme-author-written-by"><?php esc_html_e( 'Written by', 'myarcadetheme' ); ?></div>
			
				<div id="myarcadetheme-author-name"><?php the_author_meta('user_firstname'); ?> <?php the_author_meta('user_lastname'); ?></div>			
					
				<div id="myarcadetheme-author-social-icons">
					<?php if ( get_the_author_meta( 'twitter' ) ) { ?><a href="<?php echo get_the_author_meta( 'twitter' ); ?>" class="myarcadetheme-twitter-icon myarcadetheme-icon-button"></a><?php } ?>
					<?php if ( get_the_author_meta( 'facebook' ) ) { ?><a href="<?php echo get_the_author_meta( 'facebook' ); ?>" class="myarcadetheme-facebook-icon myarcadetheme-icon-button"></a><?php } ?>
					<?php if ( get_the_author_meta( 'googleplus' ) ) { ?><a href="<?php echo get_the_author_meta( 'googleplus' ); ?>" class="myarcadetheme-google-plus-icon myarcadetheme-icon-button"></a><?php } ?>
					<?php if ( get_the_author_meta( 'pinterest' ) ) { ?><a href="<?php echo get_the_author_meta( 'pinterest' ); ?>" class="myarcadetheme-pinterest-icon myarcadetheme-icon-button"></a><?php } ?>
					<?php if ( get_the_author_meta( 'youtube' ) ) { ?><a href="<?php echo get_the_author_meta( 'youtube' ); ?>" class="myarcadetheme-youtube-icon myarcadetheme-icon-button"></a><?php } ?>
					<?php if ( get_the_author_meta( 'vimeo' ) ) { ?><a href="<?php echo get_the_author_meta( 'vimeo' ); ?>" class="myarcadetheme-vimeo-icon myarcadetheme-icon-button"></a><?php } ?>
					<?php if ( get_the_author_meta( 'flickr' ) ) { ?><a href="<?php echo get_the_author_meta( 'flickr' ); ?>" class="myarcadetheme-flickr-icon myarcadetheme-icon-button"></a><?php } ?>
					<?php if ( get_the_author_meta( 'linkedin' ) ) { ?><a href="<?php echo get_the_author_meta( 'linkedin' ); ?>" class="myarcadetheme-linkedin-icon myarcadetheme-icon-button"></a><?php } ?>
					<?php if ( get_the_author_meta( 'instagram' ) ) { ?><a href="<?php echo get_the_author_meta( 'instagram' ); ?>" class="myarcadetheme-instagram-icon myarcadetheme-icon-button"></a><?php } ?>
				</div>
		
			</div>

			<div id="myarcadetheme-author-desc">
				<?php the_author_meta( 'description' ); ?>
			</div>

		</div>

	</div>
<?php } ?>