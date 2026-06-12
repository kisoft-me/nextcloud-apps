<?php

namespace OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Writer\Pdf;

use OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Writer\Pdf;
/** @internal */
class Dompdf extends Pdf
{
    /**
     * embed images, or link to images.
     */
    protected bool $embedImages = \true;
    /**
     * Gets the implementation of external PDF library that should be used.
     *
     * @return \Dompdf\Dompdf implementation
     */
    protected function createExternalWriterInstance() : \OCA\Tables\Vendor\Dompdf\Dompdf
    {
        return new \OCA\Tables\Vendor\Dompdf\Dompdf();
    }
    /**
     * Save Spreadsheet to file.
     *
     * @param string $filename Name of the file to save as
     */
    public function save($filename, int $flags = 0) : void
    {
        $fileHandle = parent::prepareForSave($filename);
        //  Check for paper size and page orientation
        $setup = $this->spreadsheet->getSheet($this->getSheetIndex() ?? 0)->getPageSetup();
        $orientation = $this->getOrientation() ?? $setup->getOrientation();
        $orientation = $orientation === PageSetup::ORIENTATION_LANDSCAPE ? 'L' : 'P';
        $printPaperSize = $this->getPaperSize() ?? $setup->getPaperSize();
        $paperSize = self::$paperSizes[$printPaperSize] ?? self::$paperSizes[PageSetup::getPaperSizeDefault()] ?? 'LETTER';
        if (\is_array($paperSize) && \count($paperSize) === 2) {
            $paperSize = [0.0, 0.0, $paperSize[0], $paperSize[1]];
        }
        $orientation = $orientation == 'L' ? 'landscape' : 'portrait';
        //  Create PDF
        $pdf = $this->createExternalWriterInstance();
        $pdf->setPaper($paperSize, $orientation);
        $pdf->loadHtml($this->generateHTMLAll());
        $pdf->render();
        //  Write to file
        \fwrite($fileHandle, $pdf->output());
        parent::restoreStateAfterSave();
    }
}
