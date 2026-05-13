<?php

namespace OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Calculation;

use OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Exception as PhpSpreadsheetException;
/** @internal */
class Exception extends PhpSpreadsheetException
{
    public const CALCULATION_ENGINE_PUSH_TO_STACK = 1;
    /**
     * Error handler callback.
     */
    public static function errorHandlerCallback(int $code, string $string, string $file, int $line) : void
    {
        $e = new self($string, $code);
        $e->line = $line;
        $e->file = $file;
        throw $e;
    }
}
