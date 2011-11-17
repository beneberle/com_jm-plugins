<?php
/**
 * @package	JM
 * @version 1.5
 * @author 	Brian Edgerton
 * @link 	http://www.edgewebworks.com
 * @copyright Copyright (C) 2011 Edge Web Works, LLC. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

defined('_JEXEC') or die();

class CategoriesModelJMHelperModel extends CategoriesModelCategories
{
	function _setCache( $store, $value )
	{
		$store = $this->getStoreId($store);
		$this->cache[$store] = $value;
	}
}