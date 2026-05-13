<?php

declare (strict_types=1);
namespace OCA\Tables\Vendor\ZipStream\Exception;

use OCA\Tables\Vendor\ZipStream\Exception;
/**
 * This Exception gets invoked if a non seekable stream is
 * provided and zero headers are disabled.
 * @internal
 */
class StreamNotSeekableException extends Exception
{
    /**
     * @internal
     */
    public function __construct()
    {
        parent::__construct('enableZeroHeader must be enable to add non seekable streams');
    }
}
