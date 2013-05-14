<?php
#Modificado por Noises of Hill para Factura Española.

class PDFGenerator extends PDFGeneratorCore
{
		/**
	 * Render the pdf file
	 *
	 * @param string $filename
         * @param  $display :  true:display to user, false:save, 'I','D','S' as fpdf display
	 * @throws PrestaShopException
	 */
	public function render($filename, $display = true)
	{
		if (empty($filename))
			throw new PrestaShopException('Missing filename.');

		$this->lastPage();

		if ($display === true)
			$output = 'D';
		elseif ($display === false)
			$output = 'S';
		elseif ($display == 'D')
			$output = 'D';
		elseif ($display == 'S')
			$output = 'S';
		else 	
			$output = 'I';
			
		return $this->output($filename, $output);
	}

	/**
	 * Write a PDF page
	 */
	public function writePage()
	{
		$this->SetHeaderMargin(2);
		$this->SetFooterMargin(20);
		$this->setMargins(17, 5, 17);
		$this->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

		$this->AddPage();

		$this->writeHTML($this->content, true, false, true, false, '');
	}
	
	/**
	 * Override of TCPDF::getRandomSeed() - getmypid() is blocked on several hosting
	*/
	protected function getRandomSeed($seed='') 
	{
		$seed .= microtime();
		if (function_exists('openssl_random_pseudo_bytes') AND (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN')) {
			// this is not used on windows systems because it is very slow for a know bug
			$seed .= openssl_random_pseudo_bytes(512);
		} else {
			for ($i = 0; $i < 23; ++$i) {
				$seed .= uniqid('', true);
			}
		}
		$seed .= uniqid('', true);
		$seed .= rand();
		$seed .= __FILE__;
		$seed .= $this->bufferlen;
		if (isset($_SERVER['REMOTE_ADDR'])) {
			$seed .= $_SERVER['REMOTE_ADDR'];
		}
		if (isset($_SERVER['HTTP_USER_AGENT'])) {
			$seed .= $_SERVER['HTTP_USER_AGENT'];
		}
		if (isset($_SERVER['HTTP_ACCEPT'])) {
			$seed .= $_SERVER['HTTP_ACCEPT'];
		}
		if (isset($_SERVER['HTTP_ACCEPT_ENCODING'])) {
			$seed .= $_SERVER['HTTP_ACCEPT_ENCODING'];
		}
		if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
			$seed .= $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		}
		if (isset($_SERVER['HTTP_ACCEPT_CHARSET'])) {
			$seed .= $_SERVER['HTTP_ACCEPT_CHARSET'];
		}
		$seed .= rand();
		$seed .= uniqid('', true);
		$seed .= microtime();
		return $seed;
	}
}

