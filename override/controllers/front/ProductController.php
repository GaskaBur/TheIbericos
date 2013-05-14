<?php

class ProductController extends ProductControllerCore
{
	/**
	 * Initialize product controller
	 * @see FrontController::init()
	 */
	public function init()
	{
		parent::init();


		if ($id_product = (int)Tools::getValue('id_product'))
			$this->product = new Product($id_product, true, $this->context->language->id, $this->context->shop->id);

		if (!Validate::isLoadedObject($this->product))
		{
			header('HTTP/1.1 404 Not Found');
			header('Status: 404 Not Found');
		}
		else
			$this->canonicalRedirection();

		if (!Validate::isLoadedObject($this->product))
			$this->errors[] = Tools::displayError('Product not found');
		else
		{
			if (Pack::isPack((int)$this->product->id) && !Pack::isInStock((int)$this->product->id))
				$this->product->quantity = 0;

			$this->product->description = $this->transformDescriptionWithImg($this->product->description);

			/*
			 * If the product is associated to the shop
			 * and is active or not active but preview mode (need token + file_exists)
			 * allow showing the product
			 * In all the others cases => 404 "Product is no longer available"
			 */
			if (!$this->product->isAssociatedToShop() || !$this->product->active)
			{
				if (Tools::getValue('adtoken') == Tools::getAdminToken('AdminProducts'.(int)Tab::getIdFromClassName('AdminProducts').(int)Tools::getValue('id_employee')))
				{
					// If the product is not active, it's the admin preview mode
					$this->context->smarty->assign('adminActionDisplay', true);
				}
				else
				{
					$this->context->smarty->assign('adminActionDisplay', false);
					if ($this->product->id_product_redirected == $this->product->id)
						$this->product->redirect_type = '404';
					
					switch ($this->product->redirect_type)
					{
						case '301':
							header('HTTP/1.1 301 Moved Permanently');
							header('Location: '.$this->context->link->getProductLink($this->product->id_product_redirected));
						break;
						case '302':
							header('HTTP/1.1 302 Moved Temporarily');
							header('Cache-Control: no-cache');
							header('Location: '.$this->context->link->getProductLink($this->product->id_product_redirected));
						break;
						case '404':
							header('HTTP/1.1 404 Not Found');
							header('Status: 404 Not Found');
							$this->errors[] = Tools::displayError('Product is no longer available.');
						break;
					}
				}
			}
			else if (!$this->product->checkAccess(isset($this->context->customer) ? $this->context->customer->id : 0))
			{
				header('HTTP/1.1 403 Forbidden');
				header('Status: 403 Forbidden');
				$this->errors[] = Tools::displayError('You do not have access to this product.');
			}
			
			// Load category
			if (isset($_SERVER['HTTP_REFERER'])
				&& !strstr($_SERVER['HTTP_REFERER'], Tools::getHttpHost()) // Assure us the previous page was one of the shop
				&& preg_match('!^(.*)\/([0-9]+)\-(.*[^\.])|(.*)id_category=([0-9]+)(.*)$!', $_SERVER['HTTP_REFERER'], $regs))
			{
				// If the previous page was a category and is a parent category of the product use this category as parent category
				if (isset($regs[2]) && is_numeric($regs[2]))
				{
					if (Product::idIsOnCategoryId((int)$this->product->id, array('0' => array('id_category' => (int)$regs[2]))))
						$this->category = new Category($regs[2], (int)$this->context->cookie->id_lang);
				}
				else if (isset($regs[5]) && is_numeric($regs[5]))
				{
					if (Product::idIsOnCategoryId((int)$this->product->id, array('0' => array('id_category' => (int)$regs[5]))))
						$this->category = new Category($regs[5], (int)$this->context->cookie->id_lang);
				}
			}
			else
				// Set default product category
				$this->category = new Category($this->product->id_category_default, (int)$this->context->cookie->id_lang);
			$this->context->smarty->assign(array("OjedaCategory" => $this->category->id));
			$this->context->smarty->assign(array("OjedaCategoryName" => $this->category->name));
		}
	}
}

