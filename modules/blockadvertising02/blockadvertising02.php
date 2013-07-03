<?php
/*
* 2007-2022 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2022 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_'))
	exit;

class BlockAdvertising02 extends Module
{
	/* Title associated to the image */
	public $adv_title02;
	
	/* Link associated to the image */
	public $adv_link02;
	
	/* Name of the image without extension */
	public $adv_imgname02;
	
	/* Image path with extension */
	public $adv_img02;

	public function __construct()
	{
		$this->name = 'blockadvertising02';
		$this->tab = 'advertising_marketing';
		$this->version = '0.5';
		$this->author = 'PrestaShop';
		$this->need_instance = 0;

		parent::__construct();

		$this->displayName = 'Bloque de Publicidad en header';
		$this->description = $this->l('Adds a block to display an advertisement.');
		
		$this->initialize();
	}

	/*
	 * Set the properties of the module, like the link to the image and the title (contextual to the current shop context)
	 */
	protected function initialize()
	{
		$this->adv_imgname02 = 'advertising';
		if ((Shop::getContext() == Shop::CONTEXT_GROUP  || Shop::getContext() == Shop::CONTEXT_SHOP)
			&& file_exists(_PS_MODULE_DIR_.$this->name.'/'.$this->adv_imgname02.'-g'.$this->context->shop->getContextShopGroupID().'.'.Configuration::get('BLOCKADVERT_IMG_EXT_02')))
			$this->adv_imgname02 .= '-g'.$this->context->shop->getContextShopGroupID();
		if (Shop::getContext() == Shop::CONTEXT_SHOP
			&& file_exists(_PS_MODULE_DIR_.$this->name.'/'.$this->adv_imgname02.'-s'.$this->context->shop->getContextShopID().'.'.Configuration::get('BLOCKADVERT_IMG_EXT_02')))
			$this->adv_imgname02 .= '-s'.$this->context->shop->getContextShopID();

		$this->adv_img02 = Tools::getMediaServer($this->name)._MODULE_DIR_.$this->name.'/'.$this->adv_imgname02.'.'.Configuration::get('BLOCKADVERT_IMG_EXT_02');
		$this->adv_link02 = htmlentities(Configuration::get('BLOCKADVERT_LINK_02'), ENT_QUOTES, 'UTF-8');
		$this->adv_title02 = htmlentities(Configuration::get('BLOCKADVERT_TITLE_02'), ENT_QUOTES, 'UTF-8');
	}
	
	public function install()
	{
		Configuration::updateValue('BLOCKADVERT_LINK_02', 'http://www.prestashop.com/');
		Configuration::updateValue('BLOCKADVERT_TITLE_02', 'PrestaShop');
		// Try to update with the extension of the image that exists in the module directory
		foreach (scandir(_PS_MODULE_DIR_.$this->name) as $file)
			if (in_array($file, array('advertising.jpg', 'advertising.gif', 'advertising.png')))
				Configuration::updateValue('BLOCKADVERT_IMG_EXT_02', substr($file, strrpos($file, '.') + 1));

		return (parent::install() && $this->registerHook('rightColumn') );
	}
	
	public function uninstall()
	{
		Configuration::deleteByName('BLOCKADVERT_LINK_02');
		Configuration::deleteByName('BLOCKADVERT_TITLE_02');
		Configuration::deleteByName('BLOCKADVERT_IMG_EXT_02');
		return (parent::uninstall());
	}

	/**
	 * delete the contextual image (it is not allowed to delete the default image)
	 *
	 * @return void
	 */
	private function _deleteCurrentImg()
	{
		// Delete the image file
		if ($this->adv_imgname02 != 'advertising' && file_exists(_PS_MODULE_DIR_.$this->name.'/'.$this->adv_imgname02.'.'.Configuration::get('BLOCKADVERT_IMG_EXT_02')))
			unlink(_PS_MODULE_DIR_.$this->name.'/'.$this->adv_imgname02.'.'.Configuration::get('BLOCKADVERT_IMG_EXT_02'));
		
		// Update the extension to the global value or the shop group value if available
		Configuration::deleteFromContext('BLOCKADVERT_IMG_EXT_02');
		Configuration::updateValue('BLOCKADVERT_IMG_EXT_02', Configuration::get('BLOCKADVERT_IMG_EXT_02'));

		// Reset the properties of the module
		$this->initialize();
	}

	public function postProcess()
	{
		if (Tools::isSubmit('submitDeleteImgConf'))
			$this->_deleteCurrentImg();

		$errors = '';
		if (Tools::isSubmit('submitAdvConf'))
		{
			if (isset($_FILES['adv_img02']) && isset($_FILES['adv_img02']['tmp_name']) && !empty($_FILES['adv_img02']['tmp_name']))
			{
				if ($error = ImageManager::validateUpload($_FILES['adv_img02'], Tools::convertBytes(ini_get('upload_max_filesize'))))
					$errors .= $error;
				else
				{
					Configuration::updateValue('BLOCKADVERT_IMG_EXT_02', substr($_FILES['adv_img02']['name'], strrpos($_FILES['adv_img02']['name'], '.') + 1));
					// Set the image name with a name contextual to the shop context
					$this->adv_imgname02 = 'advertising';
					if (Shop::getContext() == Shop::CONTEXT_GROUP)
						$this->adv_imgname02 = 'advertising'.'-g'.(int)$this->context->shop->getContextShopGroupID();
					elseif (Shop::getContext() == Shop::CONTEXT_SHOP)
						$this->adv_imgname02 = 'advertising'.'-s'.(int)$this->context->shop->getContextShopID();

					// Copy the image in the module directory with its new name
					if (!move_uploaded_file($_FILES['adv_img02']['tmp_name'], _PS_MODULE_DIR_.$this->name.'/'.$this->adv_imgname02.'.'.Configuration::get('BLOCKADVERT_IMG_EXT_02')))
						$errors .= $this->l('Error move uploaded file');
				}
			}
			
			// If the link is not set, then delete it in order to use the next default value (either the global value or the group value)
			if ($link = Tools::getValue('adv_link02'))
				Configuration::updateValue('BLOCKADVERT_LINK_02', $link);
			elseif (Shop::getContext() == Shop::CONTEXT_SHOP || Shop::getContext() == Shop::CONTEXT_GROUP)
				Configuration::deleteFromContext('BLOCKADVERT_LINK_02');
				
			// If the title is not set, then delete it in order to use the next default value (either the global value or the group value)
			if ($title = Tools::getValue('adv_title02'))
				Configuration::updateValue('BLOCKADVERT_TITLE_02', $title);
			elseif (Shop::getContext() == Shop::CONTEXT_SHOP || Shop::getContext() == Shop::CONTEXT_GROUP)
				Configuration::deleteFromContext('BLOCKADVERT_TITLE_02');
			
			// Reset the module properties
			$this->initialize();
		}
		if ($errors)
			echo $this->displayError($errors);
	}

	/**
	 * getContent used to display admin module form
	 *
	 * @return string content
	 */
	public function getContent()
	{
		$this->postProcess();
		$output = '
		<form action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'" method="post" enctype="multipart/form-data">
			<fieldset>
				<legend>'.$this->l('Advertising block configuration').'</legend>';
		if ($this->adv_img02)
		{
			$output .= '
			<a href="'.$this->adv_link02.'" target="_blank" title="'.$this->adv_title02.'">
				<img src="'.$this->context->link->protocol_content.$this->adv_img02.'" alt="'.$this->adv_title02.'" title="'.$this->adv_title02.'"
					style="width:155px;height:163px;margin-left:100px"/>
			</a>';
			if ($this->adv_imgname02 == 'advertising')
				$output .= $this->l('You cannot delete the default image (but you can change it below).');
			else
				$output .= '<input class="button" type="submit" name="submitDeleteImgConf" value="'.$this->l('Delete image').'" style=""/>';
		}
		else
			$output .= '<div style="margin-left: 100px;width:163px;">'.$this->l('no image').'</div>';
		$output .= '<br/><br/>
				<label for="adv_img">'.$this->l('Change image').'&nbsp;&nbsp;</label>
				<div class="margin-form">
					<input id="adv_img02" type="file" name="adv_img02" />
					<p>'.$this->l('Image will be displayed as 155x163.').'</p>
				</div>
				<br class="clear"/>
				<label for="adv_link">'.$this->l('Image link').'</label>
				<div class="margin-form">
					<input id="adv_link02" type="text" name="adv_link02" value="'.$this->adv_link02.'" style="width:250px" />
				</div>
				<br class="clear"/>
				<label for="adv_title">'.$this->l('Title').'</label>
				<div class="margin-form">
					<input id="adv_title02" type="text" name="adv_title02" value="'.$this->adv_title02.'" style="width:250px" />
				</div>
				<br class="clear"/>
				<div class="margin-form">
					<input class="button" type="submit" name="submitAdvConf" value="'.$this->l('Validate').'"/>
				</div>
				<br class="clear"/>
			</fieldset>
		</form>';
		return $output;
	}

	public function hookRightColumn($params)
	{
		$this->smarty->assign(array(
			'image' => $this->context->link->protocol_content.$this->adv_img02,
			'adv_link' => $this->adv_link02,
			'adv_title' => $this->adv_title02,
		));

		return $this->display(__FILE__, 'blockadvertising02.tpl');
	}

	public function hookLeftColumn($params)
	{
		return $this->hookRightColumn($params);
	}

	public function hookHeader($params)
	{
		$this->context->controller->addCSS($this->_path.'blockadvertising02.css', 'all');
	}
}