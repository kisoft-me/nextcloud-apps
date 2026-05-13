<?php

namespace OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Style\NumberFormat\Wizard;

use NumberFormatter;
use OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Exception;
/** @internal */
final class Locale
{
    /**
     * Language code: ISO-639 2 character, alpha.
     * Optional script code: ISO-15924 4 alpha.
     * Optional country code: ISO-3166-1, 2 character alpha.
     * Separated by underscores or dashes.
     */
    public const STRUCTURE = '/^(?P<language>[a-z]{2})([-_](?P<script>[a-z]{4}))?([-_](?P<country>[a-z]{2}))?$/i';
    private NumberFormatter $formatter;
    public function __construct(?string $locale, int $style)
    {
        $formatterLocale = \str_replace('-', '_', $locale ?? '');
        $this->formatter = new NumberFormatter($formatterLocale, $style);
        if ($this->formatter->getLocale() !== $formatterLocale) {
            throw new Exception("Unable to read locale data for '{$locale}'");
        }
    }
    public function format(bool $stripRlm = \true) : string
    {
        $str = $this->formatter->getPattern();
        return $stripRlm && \str_starts_with($str, "‏") ? \substr($str, 3) : $str;
    }
}
