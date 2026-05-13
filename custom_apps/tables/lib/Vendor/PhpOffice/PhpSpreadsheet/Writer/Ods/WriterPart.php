<?php

namespace OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Writer\Ods;

use OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Writer\Ods;
/** @internal */
abstract class WriterPart
{
    /**
     * Parent Ods object.
     */
    private Ods $parentWriter;
    /**
     * Get Ods writer.
     */
    public function getParentWriter() : Ods
    {
        return $this->parentWriter;
    }
    /**
     * Set parent Ods writer.
     */
    public function __construct(Ods $writer)
    {
        $this->parentWriter = $writer;
    }
    public abstract function write() : string;
}
