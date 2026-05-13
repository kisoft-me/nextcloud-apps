<?php

namespace OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Chart\Renderer;

use OCA\Tables\Vendor\mitoteam\jpgraph\MtJpGraph;
/**
 * Jpgraph is not officially maintained by Composer at packagist.org.
 *
 * This renderer implementation uses package
 * https://packagist.org/packages/mitoteam/jpgraph
 *
 * This package is up to date for June 2023 and has PHP 8.2 support.
 * @internal
 */
class MtJpGraphRenderer extends JpGraphRendererBase
{
    protected static function init() : void
    {
        static $loaded = \false;
        if ($loaded) {
            return;
        }
        MtJpGraph::load(['bar', 'contour', 'line', 'pie', 'pie3d', 'radar', 'regstat', 'scatter', 'stock'], \true);
        // enable Extended mode
        $loaded = \true;
    }
}
