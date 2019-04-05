<?php
			$default = '';
			$fp_youtube 			= get_theme_mod( 'fp-youtube', $default );
			$fp_movie_mp4			= get_theme_mod( 'fp-movie-mp4', $default );
			$fp_movie_webm		= get_theme_mod( 'fp-movie-webm', $default );
			$fp_movie_comment	= get_theme_mod( 'fp-movie-comment', $default );
			
			if( !empty($fp_youtube) );

							// Add html and functions.

								function fp_youtube() {
									echo '<iframe width="100%" height="100%" class="youtube-vid" src="https://www.youtube.com/embed/'.get_theme_mod('fp-youtube').'?rel=0&autoplay=1&loop=1&mute=1&controls=0" frameborder="0"
									allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
								}
								fp_youtube();


				 elseif(!empty( $fp_movie_mp4 || $fp_movie_webm ));


					// Add html and functions.
					 			echo $fp_movie_webm;
					 			echo $fp_movie_mp4;
							 	echo $fp_movie_comment;

				 elseif(empty( $fp_youtube && $fp_movie_mp4 && $fp_movie_mp4 ));

				 // Add html and functions.

			 endif; ?>
