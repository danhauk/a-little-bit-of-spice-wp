<?php
/**
 * A Little Bit of Spice Theme authors widget
 *
 * @package A_Little_Bit_of_Spice
 */
class Authors_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'authors_widget', // Base ID
			__('Authors Widget', 'text_domain'), // Name
			array( 'description' => __( 'Tell your readers about the authors of this site.', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
    echo $args['before_widget'];

		if ( $instance['author1'] ) {
			$email = strtolower( trim( $instance['author1'] ) );
			$hash = md5( $email );
			$author1_url = "https://www.gravatar.com/avatar/{$hash}?s=200";
		}

		if ( $instance['author2'] ) {
			$email = strtolower( trim( $instance['author2'] ) );
			$hash = md5( $email );
			$author2_url = "https://www.gravatar.com/avatar/{$hash}?s=200";
		}

		?>
			<div class="author-badge">
				<div class="about-me">
					<?php if ( isset( $author1_url ) ): ?>
						<img src="<?php echo $author1_url; ?>" class="img-link" />
					<?php endif; ?>

					<?php if ( isset( $author2_url ) ): ?>
						<img src="<?php echo $author2_url; ?>" class="img-link" />
					<?php endif; ?>

					<p><?php echo $instance[ 'bio' ]; ?></p>
				</div>
			</div>
		<?php

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$author1 = isset( $instance['author1'] ) ? $instance['author1'] : '';
		$author2 = isset( $instance['author2'] ) ? $instance['author2'] : '';
		$bio = isset( $instance['bio'] ) ? $instance['bio'] : '';
		?>
		<p>Enter email addresses for the authors and your <a href="https://gravatar.com">Gravatar</a> will be displayed.</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'author1' ); ?>"><?php _e( 'Author 1:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'author1' ); ?>" name="<?php echo $this->get_field_name( 'author1' ); ?>" type="email" value="<?php echo esc_attr( $author1 ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'author2' ); ?>"><?php _e( 'Author 2:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'author2' ); ?>" name="<?php echo $this->get_field_name( 'author2' ); ?>" type="email" value="<?php echo esc_attr( $author2 ); ?>">
		</p>
		<hr>
		<p>Write a short bio to be displayed in the sidebar.</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'bio' ); ?>"><?php _e( 'Bio:' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'bio' ); ?>" name="<?php echo $this->get_field_name( 'bio' ); ?>"><?php echo esc_attr( $bio ); ?></textarea>
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();

		$instance['author1'] = ( ! empty( $new_instance['author1'] ) ) ? strip_tags( $new_instance['author1'] ) : '';
		$instance['author2'] = ( ! empty( $new_instance['author2'] ) ) ? strip_tags( $new_instance['author2'] ) : '';
		$instance['bio'] = ( ! empty( $new_instance['bio'] ) ) ? strip_tags( $new_instance['bio'] ) : '';

		return $instance;
	}

} // register Social_Widget
add_action( 'widgets_init', function(){
	register_widget( 'Authors_Widget' );
});
