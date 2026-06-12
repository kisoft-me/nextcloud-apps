<?php

namespace OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Chart\Renderer;

/**
 * Jpgraph is not officially maintained in Composer, so the version there
 * could be out of date. For that reason, all unit test requiring Jpgraph
 * are skipped. So, do not measure code coverage for this class till that
 * is fixed.
 *
 * This implementation uses abandoned package
 * https://packagist.org/packages/jpgraph/jpgraph
 *
 * @codeCoverageIgnore
 * @internal
 */
class JpGraph extends JpGraphRendererBase
{
    protected static function init() : void
    {
        static $loaded = \false;
        if ($loaded) {
            return;
        }
        // JpGraph is no longer included with distribution, but user may install it.
        // So Scrutinizer's complaint that it can't find it is reasonable, but unfixable.
        \OCA\Tables\Vendor\JpGraph\JpGraph::load();
        \OCA\Tables\Vendor\JpGraph\JpGraph::module('bar');
        \OCA\Tables\Vendor\JpGraph\JpGraph::module('contour');
        \OCA\Tables\Vendor\JpGraph\JpGraph::module('line');
        \OCA\Tables\Vendor\JpGraph\JpGraph::module('pie');
        \OCA\Tables\Vendor\JpGraph\JpGraph::module('pie3d');
        \OCA\Tables\Vendor\JpGraph\JpGraph::module('radar');
        \OCA\Tables\Vendor\JpGraph\JpGraph::module('regstat');
        \OCA\Tables\Vendor\JpGraph\JpGraph::module('scatter');
        \OCA\Tables\Vendor\JpGraph\JpGraph::module('stock');
        $loaded = \true;
    }
}
