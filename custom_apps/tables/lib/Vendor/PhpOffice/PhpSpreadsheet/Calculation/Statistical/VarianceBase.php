<?php

namespace OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Calculation\Statistical;

use OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Calculation\Functions;
/** @internal */
abstract class VarianceBase
{
    protected static function datatypeAdjustmentAllowStrings(int|float|string|bool $value) : int|float
    {
        if (\is_bool($value)) {
            return (int) $value;
        } elseif (\is_string($value)) {
            return 0;
        }
        return $value;
    }
    protected static function datatypeAdjustmentBooleans(mixed $value) : mixed
    {
        if (\is_bool($value) && Functions::getCompatibilityMode() == Functions::COMPATIBILITY_OPENOFFICE) {
            return (int) $value;
        }
        return $value;
    }
}
