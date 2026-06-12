<?php

namespace OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Calculation\Engine\Operands;

/** @internal */
interface Operand
{
    /** @param string[] $matches */
    public static function fromParser(string $formula, int $index, array $matches) : self;
    public function value() : string;
}
