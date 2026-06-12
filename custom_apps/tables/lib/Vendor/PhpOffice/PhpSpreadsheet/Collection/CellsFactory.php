<?php

namespace OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Collection;

use OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Settings;
use OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
/** @internal */
abstract class CellsFactory
{
    /**
     * Initialise the cache storage.
     *
     * @param Worksheet $worksheet Enable cell caching for this worksheet
     *
     * */
    public static function getInstance(Worksheet $worksheet) : Cells
    {
        return new Cells($worksheet, Settings::getCache());
    }
}
