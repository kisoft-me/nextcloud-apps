<?php

namespace OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Chart\Renderer;

use OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Chart\Chart;
/** @internal */
interface IRenderer
{
    /**
     * IRenderer constructor.
     */
    public function __construct(Chart $chart);
    /**
     * Render the chart to given file (or stream).
     *
     * @param ?string $filename Name of the file render to
     *
     * @return bool true on success
     */
    public function render(?string $filename) : bool;
}
