<?php

#Modificado por Noises of Hill para Factura Española.

class HTMLTemplateDeliverySlip extends HTMLTemplateDeliverySlipCore
{
	/**
	 * Returns the template's HTML content
	 * @return string HTML content
	 */
	public function getContent()
	{
		$delivery_address = new Address((int)$this->order->id_address_delivery);
		$formatted_delivery_address = AddressFormat::generateAddress($delivery_address, array(), '<br />', ' ');
		$formatted_invoice_address = '';

		if ($this->order->id_address_delivery != $this->order->id_address_invoice)
		{
			$invoice_address = new Address((int)$this->order->id_address_invoice);
			$formatted_invoice_address = AddressFormat::generateAddress($invoice_address, array(), '<br />', ' ');
		}

		$this->smarty->assign(array(
			'order' => $this->order,
			'order_details' => $this->order_invoice->getProducts(),
			'delivery_address' => $formatted_delivery_address,
			'invoice_address' => $formatted_invoice_address,
			'order_invoice' => $this->order_invoice,
			'messages' => Message::getMessagesByOrderId($this->order->id, true)
		));

		return $this->smarty->fetch($this->getTemplate('delivery-slip'));
	}

}

