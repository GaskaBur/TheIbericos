<?php

#Modificado Por Noises of Hill para factura Española
class PdfInvoiceController extends PdfInvoiceControllerCore
{
	public function display()
	{	
		$order_invoice_list = $this->order->getInvoicesCollection();
		Hook::exec('actionPDFInvoiceRender', array('order_invoice_list' => $order_invoice_list));

		$pdf = new PDF($order_invoice_list, PDF::TEMPLATE_INVOICE, $this->context->smarty, $this->context->language->id);
		ob_clean();
		$pdf->render();
	}
}

