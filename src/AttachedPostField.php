<?php

namespace AttachedPostField;

use Exception;

/**
 * AttachedPostField (CMB2)
 *
 * @author Andrew McLagan
 */

class AttachedPostField 
{
	/**
	 * Current version number
	 *
	 * @param const VERSION
	 */
	const VERSION = '0.1.0';

	/**
	 * Field type name
	 *
	 * @param static String
	 */
	protected static $name = 'attached_post';	
	
	/**
	 * Current version number
	 *
	 * @param const VERSION
	 */
	protected static $viewPath = __DIR__.'/../views';

	/**
	 * Default post query args
	 *
	 * @param const VERSION
	 */
	protected static $defaultQueryArgs = [
		'post_type'			=> 'post',
		'posts_per_page'	=> 100,
		'orderby'			=> 'name',
		'order'				=> 'ASC',
	];

	/**
	 * Object constructor
	 *
	 * @return void
	 */
	public function __construct() 
	{
		add_action('cmb2_render_'.self::$name, [$this, 'render'], 10, 5);
	}

	/**
	 * Render the field
	 *
	 * @return Mixed
	 */	
	public function render($field, $escapedValue, $objectId, $objectType, $fieldType) 
	{
		// Default args
		$args = wp_parse_args((array) $field->options('query_args'), self::$defaultQueryArgs);

		$defaultText = ($field->options('default_text')) ? $field->options('default_text') : 'Select a post';

		$static = ($field->options('static')) ? $field->options('static') : false;
		
		if ($posts = $this->getPosts($args)) {

			if (!$static) {
				$this->postsDropdown($posts, $fieldType, $escapedValue, $defaultText);
			}

			$fieldType->_desc(true, true);	

			if ($attachedPost = get_post($escapedValue)) {
				echo "<p class='cmb2-metabox-description'><a href='".get_edit_post_link($attachedPost->ID)."''>".$attachedPost->post_title."</a></p>";	
			}
		}
		else {
			$this->noPostsFound();
		}
	}

	/**
	 * retrieve posts
	 *
	 * @return Mixed
	 */	
	public function getPosts($args = []) 
	{	
		$args = array_merge($args, [
			'posts_per_page'	=> -1,
		]);

		if ($posts = get_posts($args)) {
			return $posts;
		}		

		return null;
	}	

	/**
	 * render no posts found
	 *
	 * @return HTML
	 */	
	public function noPostsFound() 
	{	
		include self::getView('no-posts-found');
	}	

	/**
	 * render attached post dropdown
	 *
	 * @return Mixed
	 */	
	public function postsDropdown($posts, $fieldType, $escapedValue = null, $default = '') 
	{	
		?><select name="<?php echo $fieldType->_name(); ?>"><?php

			?><option value="-1"><?php echo $default; ?></option><?php

			foreach ($posts as $post) {
				$selected = ($escapedValue == $post->ID) ? 'selected' : '';

				?><option value="<?php echo $post->ID; ?>" <?php echo $selected; ?>><?php echo $post->post_title; ?></option><?php
			}

		?></select><?php 
	}			

	/**
	 * render no posts found
	 *
	 * @return Mixed
	 */	
	protected function getView($view) 
	{	
		$path = self::$viewPath . '/' . $view . '.php';

		if (file_exists($path)) {
			return $path;
		}

		throw new Exception('File Not found'); 
	}
}