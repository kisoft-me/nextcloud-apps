<?php

namespace OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Calculation\Engineering;

use OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Calculation\Exception;
use OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
/** @internal */
class EngineeringValidations
{
    public static function validateFloat(mixed $value) : float
    {
        if (!\is_numeric($value)) {
            throw new Exception(ExcelError::VALUE());
        }
        return (float) $value;
    }
    public static function validateInt(mixed $value) : int
    {
        if (!\is_numeric($value)) {
            throw new Exception(ExcelError::VALUE());
        }
        return (int) \floor((float) $value);
    }
}
