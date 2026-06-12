<?php

declare (strict_types=1);
namespace OCA\Tables\Vendor\ZipStream\Exception;

use OCA\Tables\Vendor\ZipStream\Exception;
/**
 * This Exception gets invoked if a stream can't be read.
 * @internal
 */
class StreamNotReadableException extends Exception
{
    /**
     * @internal
     */
    public function __construct()
    {
        parent::__construct('The stream could not be read.');
    }
}
