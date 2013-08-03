<?php

class Category extends CategoryCore
{
	public $nombre_corto;

	/**
	 * @see ObjectModel::$definition
	 */
	public static $definition = array(
		'table' => 'category',
		'primary' => 'id_category',
		'multilang' => true,
		'multilang_shop' => true,
		'fields' => array(
			'nleft' => 				array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
			'nright' => 			array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
			'level_depth' => 		array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
			'active' => 			array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true),
			'id_parent' => 			array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
			'id_shop_default' => 	array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
			'is_root_category' => 	array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
			'position' => 			array('type' => self::TYPE_INT),
			'date_add' => 			array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
			'date_upd' => 			array('type' => self::TYPE_DATE, 'validate' => 'isDate'),

			// Lang fields
			'name' => 				array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCatalogName', 'required' => true, 'size' => 64),
			'nombre_corto' => 		array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 50),
			'link_rewrite' => 		array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isLinkRewrite', 'required' => true, 'size' => 64),
			'description' => 		array('type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isString'),
			'meta_title' => 		array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 128),
			'meta_description' => 	array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 255),
			'meta_keywords' => 		array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 255),
		),
	);
	
	/**
	  * Return current category childs
	  *
	  * @param integer $id_lang Language ID
	  * @param boolean $active return only active categories
	  * @return array Categories
	  */
	public function getSubCategories($id_lang, $active = true)
	{
	 	if (!Validate::isBool($active))
	 		die(Tools::displayError());

		$groups = FrontController::getCurrentCustomerGroups();
		$sql_groups = (count($groups) ? 'IN ('.implode(',', $groups).')' : '= 1');

		$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT c.*, cl.id_lang, cl.name,cl.nombre_corto, cl.description, cl.link_rewrite, cl.meta_title, cl.meta_keywords, cl.meta_description
			FROM `'._DB_PREFIX_.'category` c
			'.Shop::addSqlAssociation('category', 'c').'
			LEFT JOIN `'._DB_PREFIX_.'category_lang` cl
				ON (c.`id_category` = cl.`id_category`
				AND `id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang('cl').')
			LEFT JOIN `'._DB_PREFIX_.'category_group` cg
				ON (cg.`id_category` = c.`id_category`)
			WHERE `id_parent` = '.(int)$this->id.'
				'.($active ? 'AND `active` = 1' : '').'
				AND cg.`id_group` '.$sql_groups.'
			GROUP BY c.`id_category`
			ORDER BY `level_depth` ASC, category_shop.`position` ASC
		');

		foreach ($result as &$row)
		{
			$row['id_image'] = file_exists(_PS_CAT_IMG_DIR_.$row['id_category'].'.jpg') ? (int)$row['id_category'] : Language::getIsoById($id_lang).'-default';
			$row['legend'] = 'no picture';
		}
		return $result;
	}

}

