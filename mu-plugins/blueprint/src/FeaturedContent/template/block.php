<?php 
/**
 * Template for Featured Content Block
 *
 * @package Blueprint Plugin
 */
?>
<div <?php echo get_block_wrapper_attributes( ['class' => 'featured-content'] ); ?>>
	<div class="featured-content__wrap">
		<?php if ( 0 === $atts['image']['id'] ) : ?>
			<img class="featured-content__image" src="<?php echo esc_url( $atts['image']['url'] ); ?>" alt="<?php echo esc_attr( $atts['image']['alt'] ); ?>">
		<?php else : ?>
			<?php echo wp_get_attachment_image( $atts['image']['id'], 'bp-card-lg', false, array('class' => 'featured-content__image' ) ); ?>
		<?php endif; ?>
		<div class="featured-content__box">
			<?php echo wp_kses_post( $content ); ?>
		</div>
	</div>
</div>
