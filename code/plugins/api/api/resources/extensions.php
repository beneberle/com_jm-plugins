<?php
/**
 * @package	API
 * @version 1.5
 * @author 	Rafael Corral
 * @link 	http://www.rafaelcorral.com
 * @copyright Copyright (C) 2011 Edge Web Works, LLC. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 */

defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

class ApiApiResourceExtensions extends ApiResource
{
	public function get()
	{
		$app = JFactory::getApplication();

		jimport('joomla.filesystem.folder');
		JPluginHelper::importPlugin('api');

		$result = $app->triggerEvent( 'register_api_plugin' );

		$plugins = array();
		foreach ( $result as $plugin ) {
			if ( !isset( $plugin->title ) || !isset( $plugin->plugin ) ) {
				continue;
			}

			$path = JFolder::makeSafe( JPATH_ROOT . "/plugins/api/{$plugin->plugin}/html" );
			if ( !JFolder::exists( $path ) ) {
				continue;
			}

			$files = JFolder::files( $path, '.', true, true );

			// Remove absolute path
			foreach ( $files as &$file ) {
				$file = str_replace( JPATH_ROOT.'/', '', $file );
			}

			$plugins[$plugin->plugin] = array(
				'title' => $plugin->title,
				'type' => $plugin->plugin,
				'version' => $plugin->version,
				'files' => $files
				);
		}

		ksort( $plugins );

		$this->plugin->setResponse( $plugins );
	}
}