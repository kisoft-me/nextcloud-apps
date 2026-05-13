<?php

declare (strict_types=1);
namespace OCA\Tables\Vendor\ZipStream\Exception;

use OCA\Tables\Vendor\ZipStream\Exception;
/**
 * This Exception gets invoked if a file wasn't found
 * @internal
 */
class FileNotReadableException extends Exception
{
    /**
     * @internal
     */
    public function __construct(public readonly string $path)
    {
        parent::__construct("The file with the path {$path} isn't readable.");
    }
}
