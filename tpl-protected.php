<?php
/**
 * Template Name: Protected Page Template
 *
 * This is an example.  You can either add the code with the comments below to
 * your template files or use this template and select it this template when
 * creating a page.  Drag this file into your theme folder if you are going
 * to do the latter.
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php // Add this before your protected content
			if(current_user_can( 'client-access' )) { ?>

				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'page' ); ?>
					<?php comments_template( '', true ); ?>
				<?php endwhile; // end of the loop. ?>

			<?php //Add this after your protected content
			echo '<a href="' . wp_logout_url( get_permalink() ) . '" title="Logout">Logout</a>';
			} else {
				if(is_user_logged_in()) {
					echo '<p>Sorry, you do not have permission to access this page.</p>';
					echo '<a href="' . wp_logout_url( get_permalink() ) . '" title="Logout">Logout</a>';
				} else {
					wp_login_form();
				}
			} ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>