<?php

namespace OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Worksheet;

/** @internal */
class HeaderFooterDrawing extends Drawing
{
    /**
     * Get hash code.
     *
     * @return string Hash code
     */
    public function getHashCode() : string
    {
        return \md5($this->getPath() . $this->name . $this->offsetX . $this->offsetY . $this->width . $this->height . __CLASS__);
    }
}
