<!DOCTYPE html>
<html>
	<head>	
		<title>The Complete Guide To The Settings API | Sandbox Theme</title>
	</head>
	<body>
	
		<?php $display_options = get_option( 'sandbox_theme_display_options' ); ?>
		<?php $social_options = get_option ( 'sandbox_theme_social_options' ); ?>
	
		<?php if( $display_options[ 'show_header' ] ) { ?>
			<div id="header">
				<h1>Sandbox Header</h1>
			</div><!-- /#header -->
		<?php } // end if ?>
		
		<?php if( $display_options[ 'show_content' ] ) { ?>
			<div id="content">
				<?php echo $social_options['twitter'] ? '<a href="' . esc_url( $social_options['twitter'] ) . '">Twitter</a>' : ''; ?>
				<?php echo $social_options['facebook'] ? '<a href="' . esc_url( $social_options['facebook'] ) . '">Facebook</a>' : ''; ?>
				<?php echo $social_options['googleplus'] ? '<a href="' . esc_url( $social_options['googleplus'] ) . '">Google+</a>' : ''; ?>
			</div><!-- /#content -->
		<?php } // end if ?>
		
		<?php if( $display_options[ 'show_footer' ] ) { ?>
			<div id="footer">
				<p>&copy; <?php echo date('Y'); ?> All Rights Reserved.</p>
			</div><!-- /#footer -->
		<?php } // end if ?>
	
	</body>
</html>

<!-- Note that the above markup is extraordinarily simple and I do not recommend using this as a foundation for theme development. It's simply providing the means by which we will be reading values from the Settings API. -->