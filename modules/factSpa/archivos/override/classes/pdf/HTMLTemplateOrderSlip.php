<?php
#Modificado por Noises of Hill para Factura Española.

class HTMLTemplateOrderSlip extends HTMLTemplateOrderSlipCore
{
	public function __construct(OrderSlip $order_slip, $smarty)
	{
		$this->order_slip = $order_slip;
		$this->order = new Order((int)$order_slip->id_order);

		$products = OrderSlip::getOrdersSlipProducts($this->order_slip->id, $this->order);
		$customized_datas = Product::getAllCustomizedDatas((int)$this->order->id_cart);
		Product::addCustomizationPrice($products, $customized_datas);

		$this->order->products = $products;
		$this->smarty = $smarty;

		// header informations
		$this->date = Tools::displayDate($this->order->invoice_date, (int)$this->order->id_lang);
		//esta cambia
		$this->title = HTMLTemplateOrderSlip::l('Slip #').Configuration::get('PS_CREDIT_SLIP_PREFIX', Context::getContext()->language->id).sprintf('%06d', (int)$this->order_slip->id);

		// footer informations
		$this->shop = new Shop((int)$this->order->id_shop);
	}
	
	public function getProductTaxesBreakdown()
	{
		$tmp_tax_infos = array();
		$infos = array(
					'total_price_tax_excl' => 0,
					'total_amount' => 0
				);

		foreach ($this->order_slip->getOrdersSlipDetail((int)$this->order_slip->id) as $order_slip_details)
		{
			$tax_calculator = OrderDetail::getTaxCalculatorStatic((int)$order_slip_details['id_order_detail']);
			$tax_amount = $tax_calculator->getTaxesAmount($order_slip_details['amount_tax_excl']);

			if ($this->order->useOneAfterAnotherTaxComputationMethod())
			{
				foreach ($tax_amount as $tax_id => $amount)
				{
					$tax = new Tax((int)$tax_id);
					if (!isset($total_tax_amount[$tax->rate]))
					{
						$tmp_tax_infos[$tax->rate]['name'] = $tax->name;
						$tmp_tax_infos[$tax->rate]['total_price_tax_excl'] = $order_slip_details['amount_tax_excl'];
						$tmp_tax_infos[$tax->rate]['total_amount'] = $amount;
					}
					else
					{
						$tmp_tax_infos[$tax->rate]['total_price_tax_excl'] += $order_slip_details['amount_tax_excl'];
						$tmp_tax_infos[$tax->rate]['total_amount'] += $amount;
					}
				}
			} 
			else 
			{
				$tax_rate = 0; //Aquí está el único cambio.
				foreach ($tax_amount as $tax_id => $amount)
				{
					$tax = new Tax((int)$tax_id);
					$tax_rate = $tax->rate;
					$infos['total_price_tax_excl'] += (float)Tools::ps_round($order_slip_details['amount_tax_excl'], 2);
					$infos['total_amount'] += (float)Tools::ps_round($amount, 2);
				}
				$tmp_tax_infos[(string)number_format($tax_rate, 3)] = $infos;
			}
		}
		
		// Delete ecotax from the total
		$ecotax =  $this->order_slip->getEcoTaxTaxesBreakdown();
		if ($ecotax)
			foreach ($tmp_tax_infos as $rate => &$row)
			{
				$row['total_price_tax_excl'] -= $ecotax[$rate]['ecotax_tax_excl'];
				$row['total_amount'] -= ($ecotax[$rate]['ecotax_tax_incl'] - $ecotax[$rate]['ecotax_tax_excl']);
			}
		
		return $tmp_tax_infos;
	}
}

