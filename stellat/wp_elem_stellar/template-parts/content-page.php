<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp_elem_stellar
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php
		the_content();
		?>

</article><!--<?php the_ID(); ?>-->
