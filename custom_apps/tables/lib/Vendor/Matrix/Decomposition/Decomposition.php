<?php

namespace OCA\Tables\Vendor\Matrix\Decomposition;

use OCA\Tables\Vendor\Matrix\Exception;
use OCA\Tables\Vendor\Matrix\Matrix;
/** @internal */
class Decomposition
{
    const LU = 'LU';
    const QR = 'QR';
    /**
     * @throws Exception
     */
    public static function decomposition($type, Matrix $matrix)
    {
        switch (\strtoupper($type)) {
            case self::LU:
                return new LU($matrix);
            case self::QR:
                return new QR($matrix);
            default:
                throw new Exception('Invalid Decomposition');
        }
    }
}
