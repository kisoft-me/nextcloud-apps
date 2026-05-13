<?php

namespace OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Writer;

use OCA\Tables\Vendor\ZipStream\ZipStream;
/** @internal */
class ZipStream3
{
    /**
     * @param resource $fileHandle
     */
    public static function newZipStream($fileHandle) : ZipStream
    {
        return new ZipStream(enableZip64: \false, outputStream: $fileHandle, sendHttpHeaders: \false, defaultEnableZeroHeader: \false);
    }
}
