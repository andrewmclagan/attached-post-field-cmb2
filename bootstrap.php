<?php

include_once "vendor/autoload.php";

use AttachedPostField\Activator;
use AttachedPostField\AttachedPostField;

/*
|--------------------------------------------------------------------------
| Plugin Activation / Deactivation
|--------------------------------------------------------------------------
*/

register_activation_hook(__FILE__, function() {
	
	Activator::setStatus(Activator::ACTIVATING);
});

register_deactivation_hook(__FILE__, function() {
	
	Activator::setStatus(Activator::DEACTIVATING);
});


/*
|--------------------------------------------------------------------------
| Plugin Activation / Deactivation
|--------------------------------------------------------------------------
*/

$attachedPostField = new AttachedPostField;