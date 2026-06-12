<?php

declare (strict_types=1);
namespace OCA\Tables\Vendor\ZipStream\Exception;

use OCA\Tables\Vendor\ZipStream\Exception;
/**
 * This Exception gets invoked if a strict simulation is executed and the file
 * information can't be determined without reading the entire file.
 * @internal
 */
class SimulationFileUnknownException extends Exception
{
    public function __construct()
    {
        parent::__construct('The details of the strict simulation file could not be determined without reading the entire file.');
    }
}
