<?php

namespace OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Reader\Xlsx;

use Stringable;
/** @internal */
class BaseParserClass
{
    protected static function boolean(mixed $value) : bool
    {
        if (\is_object($value)) {
            $value = $value instanceof Stringable ? (string) $value : 'true';
        }
        if (\is_numeric($value)) {
            return (bool) $value;
        }
        return $value === 'true' || $value === 'TRUE';
    }
}
