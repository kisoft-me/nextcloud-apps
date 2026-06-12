<?php

namespace OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Writer\Xlsx;
/** @internal */
abstract class WriterPart
{
    /**
     * Parent Xlsx object.
     */
    private Xlsx $parentWriter;
    /**
     * Get parent Xlsx object.
     */
    public function getParentWriter() : Xlsx
    {
        return $this->parentWriter;
    }
    /**
     * Set parent Xlsx object.
     */
    public function __construct(Xlsx $writer)
    {
        $this->parentWriter = $writer;
    }
}
