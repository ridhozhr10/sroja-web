<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-m-stacked-content-holder">
		<?php if ( ! empty( $main_image ) ) : ?>
			<?php echo wp_get_attachment_image( $main_image, 'full', false, array( 'class' => 'qodef-e-image qodef--main' ) ); ?>
		<?php endif; ?>
		
		<?php if ( ! empty( $title ) || ! empty( $text_field ) ) : ?>
			<div class="qodef-m-content qodef--stack">
				<?php if ( ! empty( $title ) ) : ?>
					<?php echo '<' . esc_attr( $title_tag ); ?> class="qodef-m-title" <?php qode_framework_inline_style( $title_styles ); ?>>
					<?php echo esc_html( $title ); ?>
					<?php echo '</' . esc_attr( $title_tag ); ?>>
				<?php endif; ?>
				
				<?php if ( ! empty( $text_field ) ) : ?>
					<div class="qodef-m-text">
						<?php echo wp_kses_post( $text_field ); ?>
					</div>
				<?php endif; ?>
				
				<?php if ( ! empty( $email ) ) : ?>
					<a href="mailto:<?php echo sanitize_email($email); ?>"><?php echo esc_html( $email ); ?></a>
				<?php endif; ?>
				
				<?php if ( ! empty( $phone ) ) : ?>
					<a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html( $phone ); ?></a>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</div>