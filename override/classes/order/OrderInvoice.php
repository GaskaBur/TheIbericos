<?php

#Modificado por Noises of Hill para Factura Española.

class OrderInvoice extends OrderInvoiceCore
{
	public function getProductTaxesBreakdown(){
        $tmp_tax_infos = array();
        $tmp_tax_infos = parent::getProductTaxesBreakdown();
        
        $context = Context::getContext();
        $currency = $context->currency;
        if (is_array($currency))
        {
            $c_char = $currency['sign'];
            $c_format = $currency['format'];
            $c_decimals = (int)$currency * _PS_PRICE_DISPLAY_PRECISION_;
            $c_blank = $currency['blank'];
        }
        elseif (is_object($currency))
        {
            $c_char = $currency->sign;
            $c_format = $currency->format;
            $c_decimals = (int)$currency->_PS_PRICE_DISPLAY_PRECISION_;
            $c_blank = $currency->blank;
        }
        else
            return false;
        
        $tax_infos = array();
        foreach($tmp_tax_infos as $key=>$tax){            
            
            switch ($c_format)
            {
                /* X 0,000.00 */
                case 1:
                        $ret = number_format($key, $c_decimals, '.', ',');
                        break;
                /* 0 000,00 X*/
                case 2:
                        $ret = number_format($key, $c_decimals, ',', ' ');
                        break;
                /* X 0.000,00 */
                case 3:
                        $ret = number_format($key, $c_decimals, ',', '.');
                        break;
                /* 0,000.00 X */
                case 4:
                        $ret = number_format($key, $c_decimals, '.', ',');
                        break;
                /* 0 000.00 X  Added for the switzerland currency */
                case 5:
                        $ret = number_format($key, $c_decimals, '.', ' ');
                        break;
            }
            $tax_infos[$ret] = $tax;
        }
        return $tax_infos;
    }
    
    public function getShippingTaxesBreakdown($order){
        $taxes_breakdown = array();
        $taxes_breakdown = parent::getShippingTaxesBreakdown($order);
        
        $context = Context::getContext();
        $currency = $context->currency;
        if (is_array($currency))
        {
            $c_char = $currency['sign'];
            $c_format = $currency['format'];
            $c_decimals = (int)$currency * _PS_PRICE_DISPLAY_PRECISION_;
            $c_blank = $currency['blank'];
        }
        elseif (is_object($currency))
        {
            $c_char = $currency->sign;
            $c_format = $currency->format;
            $c_decimals = (int)$currency-> _PS_PRICE_DISPLAY_PRECISION_;
            $c_blank = $currency->blank;
        }
        else
            return false;
        
        foreach($taxes_breakdown as $key=>$tax){            
            
            switch ($c_format)
            {
                /* X 0,000.00 */
                case 1:
                        $ret = number_format($tax['rate'], $c_decimals, '.', ',');
                        break;
                /* 0 000,00 X*/
                case 2:
                        $ret = number_format($tax['rate'], $c_decimals, ',', ' ');
                        break;
                /* X 0.000,00 */
                case 3:
                        $ret = number_format($tax['rate'], $c_decimals, ',', '.');
                        break;
                /* 0,000.00 X */
                case 4:
                        $ret = number_format($tax['rate'], $c_decimals, '.', ',');
                        break;
                /* 0 000.00 X  Added for the switzerland currency */
                case 5:
                        $ret = number_format($tax['rate'], $c_decimals, '.', ' ');
                        break;
            }
            $taxes_breakdown[$key]['rate'] = $ret;
        }
        return $taxes_breakdown;
    }
}

