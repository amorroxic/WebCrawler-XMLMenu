<?php

class Crawler_Writer_Pdf extends Crawler_Writer_Core {

	private $fileName;

	protected function store() {

		$this->fileName = ROOTDIR . '/storage/pdf/' . $this->_cacheKey . ".pdf";
		try {
			// please read the descriptive text inside /library/SirShurf/readme in relation with this package. Thanks!
			$pdf = new SirShurf_Pdf_TableSet();
			$table = $pdf->addTable();

			$objTableRow = $table->addRow();
			$objTableRow->addCol( 'URL: ' . $this->textTrim($this->_url) , array ('size'=>20, 'bold' => true) );
			$objTableRow = $table->addRow();
			$objTableRow->addCol( 'Assets in total: ' . count($this->_assets) , array ('size'=>20, 'bold' => true) );

			$objTableRow = $table->addRow();
			$column = $objTableRow->addCol( '' , array ('size'=>20, 'bold' => false) );

			// add data
			$i=0;
			foreach ($this->_assets as $asset=>$assetCount) {
				$i++;
				$objTableRow = $table->addRow();
				$objTableRow->addCol( 'Asset: ' . $this->textTrim($asset) , array ('size'=>20, 'bold' => false) );
				$objTableRow = $table->addRow();
				$objTableRow->addCol( 'Asset count: ' . $assetCount , array ('size'=>20, 'bold' => false) );
				$objTableRow = $table->addRow();
				$column = $objTableRow->addCol( '' , array ('size'=>20, 'bold' => false) );

				if ($i%20 == 0) {
					$pdf->addNewPage();
					$table = $pdf->addTable();
				}
			}

			// and save file
			$pdf->build ( $this->fileName );

		} catch (Exception $e) {
			throw new Crawler_Writer_Exception(Crawler_Writer_Exception::ERROR_WRITING);
		}

	}

	private function textTrim($text="",$length=100,$amountLastCharacters=28) {

		$delimitator = " ... ";
		$delimitatorLength = strlen($delimitator);
		if (strlen($text) > $length) $text = substr($text,0,$length-$delimitatorLength-$amountLastCharacters) . $delimitator . substr($text, -$amountLastCharacters);
		return $text;

	}

}