Attached Posts Field CMB2
==================

Custom field for [CMB2](https://github.com/WebDevStudios/CMB2).

Create a dropdown feild listing a post type for creating a post-to-post style relationship. Saves the post ID into a custom meta field.

Example:

````
			'ticket_id' => [
				'id' 			=> 'ticket_id',
				'label'			=> 'Ticket Type',
				'description'	=> '',
				'class'			=> [''],
				'input_class'	=> ['attendee-ticket_id'],
				'placeholder'	=> 'Select your ticket',
				'type'			=> 'post_type',
				'options'		=> [
					'post_type'	=> 'product',
					'query'		=> [
						''
					],
				],
				'required'		=> true,		
			],	
````
