<?php

namespace OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Writer\Xls;

/** @internal */
class ErrorCode
{
    /**
     * @var array<string, int>
     */
    protected static array $errorCodeMap = ['#NULL!' => 0x0, '#DIV/0!' => 0x7, '#VALUE!' => 0xf, '#REF!' => 0x17, '#NAME?' => 0x1d, '#NUM!' => 0x24, '#N/A' => 0x2a];
    public static function error(string $errorCode) : int
    {
        return self::$errorCodeMap[$errorCode] ?? 0;
    }
}
