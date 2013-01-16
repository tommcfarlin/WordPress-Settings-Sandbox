<!DOCTYPE html>
<html>
	<head>	
		<title>The Complete Guide To The Settings API | Sandbox Theme</title>
	</head>
	<body>
	
		<?php $display_options = get_option( 'sandbox_theme_display_options' ); ?>
		<?php $social_options = get_option ( 'sandbox_theme_social_options' ); ?>
		<?php $input_examples = get_option('sandbox_theme_input_examples'); ?>
	
		<?php if( isset( $display_options['show_header'] ) && $display_options[ 'show_header' ] ) { ?>
			<div id="header">
				<h1>Sandbox Header</h1>
			</div><!-- /#header -->
		<?php } // end if ?>
		
		<?php if( isset( $display_options['show_content'] ) && $display_options[ 'show_content' ] ) { ?>
			<div id="content">
				<?php echo $social_options['twitter'] ? '<a href="' . esc_url( $social_options['twitter'] ) . '">Twitter</a>' : ''; ?>
				<?php echo $social_options['facebook'] ? '<a href="' . esc_url( $social_options['facebook'] ) . '">Facebook</a>' : ''; ?>
				<?php echo $social_options['googleplus'] ? '<a href="' . esc_url( $social_options['googleplus'] ) . '">Google+</a>' : ''; ?>
			</div><!-- /#content -->
		<?php } // end if ?>
		
		<?php if( isset( $display_options['show_footer'] ) && $display_options['show_footer'] ) { ?>
			<div id="footer">
				<p>&copy; <?php echo date( 'Y' ); ?> All Rights Reserved.</p>
			</div><!-- /#footer -->
		<?php } // end if ?>

		<?php if( isset( $input_examples['input_example'] ) && $input_examples['input_example'] ) { ?>
			<?php echo sanitize_text_field( $input_examples['input_example'] ); ?>
		<?php } // end if ?>

		<?php if( isset( $input_examples['textarea_example'] ) &&  $input_examples['textarea_example'] ) { ?>
			<?php echo sanitize_text_field( $input_examples['textarea_example'] ); ?>
		<?php } // end if ?>
		
		<?php if( '1' == $input_examples['checkbox_example'] ) { ?>
			<p>The checkbox has been checked.</p>
		<?php } else { ?>
			<p>The checkbox has not been checked.</p>
		<?php } // end if  ?>
		
		<?php if( 1 == $input_examples['radio_example'] ) { ?>
			<p>The first option was selected.</p>
		<?php } elseif( 2 == $input_examples['radio_example'] ) { ?>
			<p>The second option was selected.</p>
		<?php } // end if  ?>
		
		<?php if( 'never' == $input_examples['time_options'] ) { ?>
			<p>Never display this. Somewhat ironic to even show this.</p>
		<?php } elseif( 'sometimes' == $input_examples['time_options'] ) { ?>
			<p>Sometimes display this.</p>
		<?php } elseif( 'always' == $input_examples['time_options'] ) { ?>
			<p>Always display this.</p>
		<?php } // end if/else ?>
	
	</body>
</html>

<!-- Note that the above markup is extraordinarily simple and I do not recommend using this as a foundation for theme development. It's simply providing the means by which we will be reading values from the Settings API. -->