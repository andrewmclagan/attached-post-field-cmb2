<?php 

namespace AttachedPostField;

/**
 * Plugin activator / deactivator
 *
 * @author Andrew McLagan <andrewmclagan@gmail.com>
 */

class Activator
{
	/**
	 * activated
	 *
	 * @var Bool
	 */
	public $activated;

	/**
	 * activated constants
	 *
	 * @var Bool
	 */
	const ACTIVATING 	= 'activating';
	const ACTIVATED 	= 'activated';
	const DEACTIVATING 	= 'deactivating';
	const DEACTIVATED 	= 'deactivated';

	/**
	 * activated option tag
	 *
	 * @var String
	 */
	const ACTIVATED_OPTION = 'event-os-activated';	

	/**
	 * Constructor
	 *
	 * @return  void
	 */
	public function __construct()
	{
		$this->activated = get_option(self::ACTIVATED_OPTION, false);
	}	

	/**
	 * Init the service provider
	 *
	 * @return void
	 */
	public function boot() 
	{
		add_action( 'init', [$this, 'runActivatorService']);
	}

	/**
	 * rens the service provider...
	 *
	 * @return void
	 */
	public function runActivatorService() 
	{
		if ($this->activated == self::ACTIVATING)
		{
			$this->activate();

			$this->setStatus(self::ACTIVATED);
		}
		elseif ($this->activated == self::DEACTIVATING)
		{
			$this->deactivate();

			$this->setStatus(self::DEACTIVATED);
		}
	}	

	/**
	 * sets the status of the activator
	 *
	 * @return Constant
	 */
	public function setStatus($statusConstant) 
	{
		return update_option(self::ACTIVATED_OPTION, $statusConstant);
	}	

	/**
	 * Plugin activation routine
	 *
	 * @return void
	 */
	public function activate()
	{ 

	}

   	/**
     * Plugin deactivation routine
     *
     * @return void
     */
    public function deactivate()
    {

    }    
}