<?php

namespace OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Writer\Ods;

/** @internal */
class Mimetype extends WriterPart
{
    /**
     * Write mimetype to plain text format.
     *
     * @return string XML Output
     */
    public function write() : string
    {
        return 'application/vnd.oasis.opendocument.spreadsheet';
    }
}
