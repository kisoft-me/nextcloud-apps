<?php

namespace OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Writer;

use OCA\Tables\Vendor\ZipStream\Option\Archive;
use OCA\Tables\Vendor\ZipStream\ZipStream;
/**
 * Either ZipStream2 or ZipStream3, but not both, may be used.
 * For code coverage testing, it will always be ZipStream3.
 *
 * @codeCoverageIgnore
 * @internal
 */
class ZipStream2
{
    /**
     * @param resource $fileHandle
     */
    public static function newZipStream($fileHandle) : ZipStream
    {
        $options = new Archive();
        $options->setEnableZip64(\false);
        $options->setOutputStream($fileHandle);
        return new ZipStream(null, $options);
    }
}
