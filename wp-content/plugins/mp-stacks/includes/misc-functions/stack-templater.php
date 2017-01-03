<?php 
/**
 * Functions Stack Template
 *
 * @link http://mintplugins.com/doc/
 * @since 1.0.0
 *
 * @package    MP Stacks
 * @subpackage Functions
 *
 * @copyright  Copyright (c) 2015, Mint Plugins
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @author      Philip Johnston
 */

 
/**
 * Function which return a template array for a stack
 * Parameter: Stack ID
 * Parameter: $args
 */
function mp_stack_template_array( $stack_id, $args = array() ){		
	
	//Attempt to increase the time limit to make sure we don't time out on servers with really low timeout settings. This won't work if safe_mode is on for PHP.
	set_time_limit( 300 );
	
	//Set defaults for args		
	$args_defaults = array();
	
	//Get and parse args
	$args = wp_parse_args( $args, $args_defaults );
	
	//Set default for stack array
	$mp_stack_template_array = array();
		
	//Set the args for the new query
	$mp_stacks_args = array(
		'post_type' => "mp_brick",
		'posts_per_page' => -1,
		'post_status' => 'publish',
		'meta_key' => 'mp_stack_order_' . $stack_id,
		'orderby' => 'meta_value_num',
		'order' => 'ASC',
		'tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'mp_stacks',
				'field'    => 'id',
				'terms'    => array( $stack_id ),
				'operator' => 'IN'
			)
		)
	);	
		
	//Create new query for stacks
	$mp_stack_query = new WP_Query( apply_filters( 'mp_stacks_args', $mp_stacks_args ) );
	
	/*
	//This is a what a stack template array looks like 
	$mp_stack_template_array = array(
		'stack_title' => "My Test Stack",
		'stack_bricks' => array(
			'brick_1' => array(
				'brick_title' => "Brick's Title",
				'mp_stack_order_' . $stack_id => '1000',
								
				'other_normal_meta_key' => array( 
					'value' => $meta_value,
					'attachment' => false,
				),
				
				'repeater_meta_key' => array( 
					'value' => array(
						'key1' => array( 
							'value' => 'Key Value 1',
							'attachment' => false,
						),
						'key2' => array( 
							'value' => 'Key Value 2',
							'attachment' => false,
						),
					),
					'attachment' => false,
				)
			),
			'brick_2' => array(
				'brick_title' => "Brick's Title",
				'mp_stack_order_' . $stack_id => '1010',
								
				'other_normal_meta_data' => array( 
					'value' => $meta_value,
					'attachment' => false,
				)
			)
		)	
	);
	*/
	
	$term_exists = get_term_by('id', $stack_id, 'mp_stacks');
	
	//If this stack doesn't exist
	if (!$term_exists){
		//Do nothing
	}
	//If there are bricks in this stack
	elseif ( $mp_stack_query->have_posts() ) {
		
		//Set the Stack Description based on whether this is a developer or not
		if ( function_exists('mp_stacks_developer_textdomain') ){
			$stack_description = __( 'Created using:', 'mp_stacks' ) . ' ' . $term_exists->description;	
		}
		else{
			$stack_description = NULL;	
		}
		
		//Build Brick Output
		$mp_stack_template_array = array(
			'stack_title' => get_the_title("New Stack Template"),
			'stack_description' => $stack_description,
		);
		
		//Brick Counter		
		$brick_counter = 1;
		
		//Mp Stack Order
		$mp_stack_order = 1000;
			
		//For each brick in this stack
		while( $mp_stack_query->have_posts() ) : $mp_stack_query->the_post(); 
    		
			//Get this brick's post id
			$post_id = get_the_ID();
			
			//Build Default Brick Output
			$mp_stack_template_array['stack_bricks']['brick_' . $brick_counter] = array(
				'brick_title' => get_the_title( $post_id ),
				'mp_stack_order' => $mp_stack_order,
			);
			
			//Get all meta field keys for this brick
			$brick_meta_keys = get_post_custom_keys( $post_id ); 
						
			//Loop through all meta fields attached to this brick
			foreach ( $brick_meta_keys as $meta_key ){
				
				//If this is the stack order, we don't need to save it because we already have above
				if ( stripos( $meta_key, 'mp_stack_order' ) === false ){ 
				
					//Get the value of this meta key
					$meta_value = get_post_meta( $post_id, $meta_key, true );
					
					//If this is a repeater	
					if ( is_array( $meta_value ) ){
						
						$meta_value_array = array();
						$repeat_counter = 0;
						
						//Loop through each repeat in this repeater
						foreach( $meta_value as $repeat ){
							
							if ( is_array( $repeat ) ){							
								//Loop through each field in this repeat
								foreach( $repeat as $field_id => $field_value ){
								
									//Add this field_value_array to the parent's meta_value_array
									$meta_value_array['value'][$repeat_counter][$field_id] = array( 
										'value' => apply_filters( 'mp_stacks_template_metafield_value', $field_value, $field_id ),
										'attachment' => false
									);								
									
								}
							}
							
							//Increment Repeat Counter
							$repeat_counter = $repeat_counter+1;
						}

					}
					else{
					
						//Set up the standard meta_value_array
						$meta_value_array = array( 
							'value' => apply_filters( 'mp_stacks_template_metafield_value', $meta_value, $meta_key ),
							'attachment' => false
						);	
					}
					
					//Add post meta fields to the array for this brick
					$mp_stack_template_array['stack_bricks']['brick_' . $brick_counter][$meta_key] = $meta_value_array;
				}			
				
			}
			
			//Filter-in any extra fields we want to save for this brick. 
			$brick_meta = $mp_stack_template_array['stack_bricks']['brick_' . $brick_counter];
			$content_type_1 = isset( $mp_stack_template_array['stack_bricks']['brick_' . $brick_counter]['brick_first_content_type']['value'] ) ? $mp_stack_template_array['stack_bricks']['brick_' . $brick_counter]['brick_first_content_type']['value'] : NULL;
			$content_type_2 = isset( $mp_stack_template_array['stack_bricks']['brick_' . $brick_counter]['brick_second_content_type'] ) ? $mp_stack_template_array['stack_bricks']['brick_' . $brick_counter]['brick_second_content_type']['value'] : NULL;
			//Filter-in any extra fields we want to save for this brick. 
			$brick_meta = apply_filters( 'mp_stacks_template_extra_meta', $brick_meta, $content_type_1, $content_type_2 );
			$mp_stack_template_array['stack_bricks']['brick_' . $brick_counter] = $brick_meta;
			
			//Increment brick counter
			$brick_counter = $brick_counter + 1;
			
			//Increment mp stack order
			$mp_stack_order = $mp_stack_order + 10;
			
		endwhile;
	
	}
	//If there aren't any bricks in this stack
	else{
		
		//Do Nothing here either.
		
	};
	
	//Reset query
	wp_reset_query();
	
	//Return
	return $mp_stack_template_array;	
}

/**
 * Function which duplicates a stack and all bricks within it
 * Parameter: Stack ID
 * Parameter: $args
 * Returns New Stack's ID
 */
function mp_stacks_duplicate_stack( $original_stack_id, $new_stack_name ){
	
	//Get the template array for the stack we want to duplicate 
	$mp_stack_template_array = mp_stack_template_array( $original_stack_id );
	
	//Create the new stack using the stack template and name
	$new_stack_id = mp_stacks_create_stack_from_template( $mp_stack_template_array, $new_stack_name );
			
	//Return the new stack id
	return $new_stack_id;
	
}

/**
 * Function which creates a new stack from a stack template array
 * Parameter: Stack Template Array
 * Parameter: Stack Name
 * Returns New Stack's ID
 */
function mp_stacks_create_stack_from_template( $mp_stack_template_array, $new_stack_name ){
	
	//Attempt to increase the time limit to make sure we don't time out on servers with really low timeout settings. This won't work if safe_mode is on for PHP.
	set_time_limit( 300 );
	
	//Make new stack
	$new_stack_array = wp_insert_term(
		$new_stack_name, // the term 
		'mp_stacks', // the taxonomy
		array(
			'description'=> isset( $mp_stack_template_array['stack_description'] ) ? $mp_stack_template_array['stack_description'] : '',
			'slug' => wp_unique_term_slug( sanitize_title($new_stack_name), (object) array( 'parent' => 0, 'taxonomy' => 'mp_stacks' ) ),
		)
	);
	
	//The new stack's id
	$new_stack_id = $new_stack_array['term_id'];
	
	//Get the wp upload dir
	$wp_upload_dir = wp_upload_dir();
	
	//Loop through each brick in the original stack
	if ( !empty( $mp_stack_template_array['stack_bricks'] ) && is_array( $mp_stack_template_array['stack_bricks'] ) ){
		foreach ( $mp_stack_template_array['stack_bricks'] as $original_brick ){
						
			//New Brick Setup
			$new_brick = array(
			  'post_title'     => $original_brick['brick_title'],
			  'post_status'    => 'publish',
			  'post_type'      => 'mp_brick',
			);  
			
			//Create a new brick 
			$new_brick_id = wp_insert_post( $new_brick, true );
			
			//Apply the new Stack ID (Taxonomy Term) to this Brick (Post)
			wp_set_object_terms( $new_brick_id, $new_stack_id, 'mp_stacks' );
			
			//Loop through the meta in the original brick
			foreach ( $original_brick as $brick_meta_id => $brick_meta_value ){
				
				//Don't save the brick title as a meta field
				if ( $brick_meta_id != 'brick_title' ){
					
					//If this meta field is the stack order one
					if ( $brick_meta_id == 'mp_stack_order' ){
						
						//Set the Stack Order
						update_post_meta( $new_brick_id, 'mp_stack_order_' . $new_stack_id, $brick_meta_value );
						
					}
					//If this meta field is the Stack ID one which tells bricks which Stack they belong to
					elseif( $brick_meta_id == 'mp_stack_id' ){
						
						//Set the Stack ID to be the new one
						update_post_meta( $new_brick_id, 'mp_stack_id', $new_stack_id );
						
					}
					//If this meta field is not the stack order one
					else{
						
						//If this is a repeater
						if ( isset( $brick_meta_value['value'] ) && is_array( $brick_meta_value['value'] ) ) {
							
							//Reset our checked meta variable
							$brick_meta_checked_value = array();
							
							$repeat_counter = 0;
							
							//Loop through each repeat in this repeater
							foreach( $brick_meta_value['value'] as $repeat ){
								
								//Loop through each field in this repeat
								foreach( $repeat as $field_id => $field_value_array ){
									
									//If this should be an imported attachment
									if ( isset( $field_value_array['attachment'] ) && $field_value_array['attachment'] ){
										$brick_meta_checked_value[$repeat_counter][$field_id] = mp_stack_check_value_for_attachment( $field_value_array['value'] );
									}
									else{
										$brick_meta_checked_value[$repeat_counter][$field_id] = $field_value_array['value'];
									}
									
								}
								
								$repeat_counter = $repeat_counter + 1;
								
							}
								
						}
						//If this is not a repeater
						else{
							//If this should be an imported attachment
							if ( isset( $brick_meta_value['attachment'] ) && $brick_meta_value['attachment'] ){
								$brick_meta_checked_value = mp_stack_check_value_for_attachment($brick_meta_value['value']);
							}
							else{
								$brick_meta_checked_value = isset( $brick_meta_value['value'] ) ? $brick_meta_value['value'] : NULL;
							}
							
						}//End of: If $brick_meta_value['value'] is not a repeater
						
						//Save the metadata to the new brick
						update_post_meta( $new_brick_id, $brick_meta_id, $brick_meta_checked_value );
							
					}
				}
				
			}
			
		}
	}
	
	return $new_stack_id;
	
}

/**
 * Function which checks if a value is an attachment, and whether it needs to be created
 * Parameter: String - The value to check for an attachment
 * Returns String - The checked value - matches the incoming value
 */
function mp_stack_check_value_for_attachment( $meta_value ){
		
	//Get the wp upload dir
	$wp_upload_dir = wp_upload_dir();
	
	//If this is a text area with HTML and it has an <img tag in it, each attachment needs to be checked manually
	if ( strpos( $meta_value, '&lt;p&gt;&lt;img' ) !== false ){
		$attachment_already_created = false; //We do this check later on where it makes more sense
	}
	//If this is a normal meta value field and its attachment has already been created
	else{
		//Check if this attachment has been created or not	
		$attachment_already_created = mp_core_get_attachment_id_from_url( $wp_upload_dir['url'] . '/' . basename( $meta_value ) );
	}
	
	//If this attachment has NOT already been created
	if ( !$attachment_already_created ){
			
		//Create this to be an attachment by taking it from the template folder
		
		if (false === ($creds = request_filesystem_credentials('', '', false, false) ) ) {

			// if we get here, then we don't have credentials yet,
			// but have just produced a form for the user to fill in, 
			// so stop processing for now
			
			return true; // stop the normal page form from displaying
		}
		
		//Now we have some credentials, try to get the wp_filesystem running
		if ( ! WP_Filesystem($creds) ) {
			// our credentials were no good, ask the user for them again
			request_filesystem_credentials('', '', true, false);
			return true;
		}
		
		//By this point, the $wp_filesystem global should be working, so let's use it get our plugin
		global $wp_filesystem;
			
		//Check if this field contains any HTML img tags
		if ( strpos( $meta_value, '&lt;p&gt;&lt;img' ) !== false ){
			
			//Get the URL in each img tag's "src" attribute
			$value_explode_results = explode( 'src=&quot;', $meta_value );
			
			$rebuilt_field_value = NULL;
			
			$mail_sent = false;
			
			$exploded_loop_counter  = 0;
			
			//Loop through each exploded string
			if ( is_array( $value_explode_results ) ){
				foreach( $value_explode_results as $value_explode_result ){
					
					if ( $exploded_loop_counter == 0 ){
						$exploded_loop_counter = $exploded_loop_counter + 1;
						continue;	
					}
					
					$exploded_loop_counter = $exploded_loop_counter + 1;
															
					//Get the image url
					$temp_explode_holder = explode( '&quot', $value_explode_result );
					$img_url = $temp_explode_holder[0];
					
					//Check if this attachment has been created or not	
					$attachment_already_created = mp_core_get_attachment_id_from_url( $wp_upload_dir['url'] . '/' . basename( $img_url ) );
					
					if ( !$attachment_already_created ){						
						//Get the image
						$saved_file = $wp_filesystem->get_contents( $img_url );
						
						$wp_upload_dir = wp_upload_dir();
							
						//Get the filename only of this attachment
						$attachment_path = parse_url( $img_url, PHP_URL_PATH);
						$attachment_parts = pathinfo($attachment_path);
						
						//Move the image to the uploads directory
						$wp_filesystem->put_contents( $wp_upload_dir['path'] . '/' . $attachment_parts['basename'], $saved_file, FS_CHMOD_FILE);
							
						//Check filetype	
						$wp_filetype = wp_check_filetype($attachment_parts['basename'], NULL );
						
						//Create attachment array
						$attachment = array(
							'guid' => $wp_upload_dir['url'] . '/' . $attachment_parts['basename'], 
							'post_mime_type' => $wp_filetype['type'],
							'post_title' => preg_replace( '/\.[^.]+$/', '', $attachment_parts['basename'] ),
							'post_content' => '',
							'post_status' => 'inherit'
						);
						
						$attach_id = wp_insert_attachment( $attachment, $wp_upload_dir['path'] . '/' . $attachment_parts['basename'] );
						
						if ( !$attach_id ){
							return NULL;
						}
							
						// we must first include the image.php file
						// for the function wp_generate_attachment_metadata() to work
						
						require_once( ABSPATH . 'wp-admin/includes/image.php' );
						
						$attach_data = wp_generate_attachment_metadata( $attach_id, $wp_upload_dir['path'] . '/' . $attachment_parts['basename']  );
						
						wp_update_attachment_metadata( $attach_id, $attach_data );
						
						$meta_value = str_replace( 'src=&quot;' . $img_url, 'src=&quot;' . $wp_upload_dir['url'] . '/' . $attachment_parts['basename'] , $meta_value );
					}
					else{
						$meta_value = str_replace( 'src=&quot;' . $img_url, 'src=&quot;' . $wp_upload_dir['url'] . '/' . basename( $img_url ), $meta_value );
					}
					
				}
			}
		}
		//If this is not a text area containing an img html tag...
		else{							
												
			//Get the image
			$saved_file = $wp_filesystem->get_contents( $meta_value );
			
			$wp_upload_dir = wp_upload_dir();
				
			//Get the filename only of this attachment
			$attachment_path = parse_url( $meta_value, PHP_URL_PATH);
			$attachment_parts = pathinfo($attachment_path);
			
			//Move the image to the uploads directory
			$wp_filesystem->put_contents( $wp_upload_dir['path'] . '/' . $attachment_parts['basename'], $saved_file, FS_CHMOD_FILE);
				
			//Check filetype	
			$wp_filetype = wp_check_filetype($attachment_parts['basename'], NULL );
			
			//Create attachment array
			$attachment = array(
				'guid' => $wp_upload_dir['url'] . '/' . $attachment_parts['basename'], 
				'post_mime_type' => $wp_filetype['type'],
				'post_title' => preg_replace( '/\.[^.]+$/', '', $attachment_parts['basename'] ),
				'post_content' => '',
				'post_status' => 'inherit'
			);
			
			$attach_id = wp_insert_attachment( $attachment, $wp_upload_dir['path'] . '/' . $attachment_parts['basename'] );
			
			if ( !$attach_id ){
				return NULL;
			}
				
			// we must first include the image.php file
			// for the function wp_generate_attachment_metadata() to work
			
			require_once( ABSPATH . 'wp-admin/includes/image.php' );
			
			$attach_data = wp_generate_attachment_metadata( $attach_id, $wp_upload_dir['path'] . '/' . $attachment_parts['basename']  );
			
			wp_update_attachment_metadata( $attach_id, $attach_data );
			
			//Tell the meta key where the new attachment is located. 
			//This works whether this is a new or old attachment - as the attachments are not overwritten so the URL should always be this:
			$meta_value = $wp_upload_dir['url'] . '/' . basename( $meta_value );
	
		}
														
	}//End of: If this attachment has NOT already been created
	
	//If this attachment HAS already been created, make sure the URL to it is correct
	else{
		
		//Check if this field contains any HTML img tags
		if ( strpos( $meta_value, '&lt;p&gt;&lt;img' ) !== false ){
			
			//Get the URL in each img tag's "src" attribute
			$value_explode_results = explode( 'src=&quot;', $meta_value );
			
			$rebuilt_field_value = NULL;
			
			$mail_sent = false;
			
			$exploded_loop_counter  = 0;
			
			//Loop through each exploded string
			if ( is_array( $value_explode_results ) ){
				foreach( $value_explode_results as $value_explode_result ){
					
					if ( $exploded_loop_counter == 0 ){
						$exploded_loop_counter = $exploded_loop_counter + 1;
						continue;	
					}
					
					$exploded_loop_counter = $exploded_loop_counter + 1;
															
					//Get the image url
					$temp_explode_holder = explode( '&quot', $value_explode_result );
					$img_url = $temp_explode_holder[0];
					
					$meta_value = str_replace( 'src=&quot;' . $img_url, 'src=&quot;' . $wp_upload_dir['url'] . '/' . basename( $img_url ), $meta_value );
					
				}
			}
		}
		//If this is not a text area containing an img html tag...
		else{	
		
			//Tell the meta key where the new attachment is located. 
			//This works whether this is a new or old attachment - as the attachments are not overwritten so the URL should always be this:
			$meta_value = $wp_upload_dir['url'] . '/' . basename( $meta_value );	
		}
	}
	
	return $meta_value;
							
}

/**
 * Get the JSON for all of a Brick's meta settings. This will not check for attachments and import the way a Stack template does.
 */
function mp_stacks_brick_json( $brick_id ){
	
	//Get this brick's post id
	$post_id = $brick_id;
	
	//Build Default Brick Output
	$mp_stack_template_array = array(
		'brick_title' => get_the_title( $post_id ),
	);
	
	//Get all meta field keys for this brick
	$brick_meta_keys = get_post_custom_keys( $post_id ); 
				
	//Loop through all meta fields attached to this brick
	foreach ( $brick_meta_keys as $meta_key ){
		
		//If this is the stack order, we don't need to save it because it will be handled by the Stack
		if ( stripos( $meta_key, 'mp_stack_order' ) !== false ){ 
		
		}
		elseif( $meta_key == 'mp_stack_id' ){
			
		}
		else{
		
			//Get the value of this meta key
			$meta_value = get_post_meta( $post_id, $meta_key, true );
			
			//If this is a repeater	
			if ( is_array( $meta_value ) ){
				
				$meta_value_array = array();
				$repeat_counter = 0;
				
				//Loop through each repeat in this repeater
				foreach( $meta_value as $repeat ){
					
					if ( is_array( $repeat ) ){							
						//Loop through each field in this repeat
						foreach( $repeat as $field_id => $field_value ){
						
							//Add this field_value_array to the parent's meta_value_array
							$meta_value_array['value'][$repeat_counter][$field_id] = array( 
								'value' => apply_filters( 'mp_stacks_template_metafield_value', $field_value, $field_id ),
								//'attachment' => false //While this value is set to be false here, it is merely a default that is not used in this scenario but is in others (eg Theme Bundles)
							);								
							
						}
					}
					
					//Increment Repeat Counter
					$repeat_counter = $repeat_counter+1;
				}

			}
			else{
			
				//Set up the standard meta_value_array
				$meta_value_array = array( 
					'value' => apply_filters( 'mp_stacks_template_metafield_value', $meta_value, $meta_key ),
					//'attachment' => false //While this value is set to be false here, it is merely a default that is not used in this scenario but is in others (eg Theme Bundles)
				);	
			}
			
			//Add post meta fields to the array for this brick
			$mp_brick_template_array[$meta_key] = $meta_value_array;
		}			
		
	}
	
	//Filter-in any extra fields we want to save for this brick. 
	$brick_meta = $mp_brick_template_array;
		
	$content_type_1 = isset( $mp_brick_template_array['brick_first_content_type']['value'] ) ? $mp_brick_template_array['brick_first_content_type']['value'] : NULL;
	$content_type_2 = isset( $mp_brick_template_array['brick_second_content_type']['value'] ) ? $mp_brick_template_array['brick_second_content_type']['value'] : NULL;
	//Filter-in any extra fields we want to save for this brick. 
	$brick_meta = apply_filters( 'mp_stacks_template_extra_meta', $brick_meta, $content_type_1, $content_type_2 );
	$mp_brick_template_array = $brick_meta;
	
	return json_encode( $mp_brick_template_array );
				
}