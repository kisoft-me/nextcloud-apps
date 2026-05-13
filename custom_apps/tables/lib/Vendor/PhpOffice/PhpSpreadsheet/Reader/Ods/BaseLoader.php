<?php

namespace OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Reader\Ods;

use DOMElement;
use OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Spreadsheet;
/** @internal */
abstract class BaseLoader
{
    protected Spreadsheet $spreadsheet;
    protected string $tableNs;
    public function __construct(Spreadsheet $spreadsheet, string $tableNs)
    {
        $this->spreadsheet = $spreadsheet;
        $this->tableNs = $tableNs;
    }
    public abstract function read(DOMElement $workbookData) : void;
}
