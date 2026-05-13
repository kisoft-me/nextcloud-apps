<?php

namespace OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Writer\Xls;

use OCA\Tables\Vendor\PhpOffice\PhpSpreadsheet\Cell\DataValidation;
/** @internal */
class CellDataValidation
{
    /**
     * @var array<string, int>
     */
    protected static array $validationTypeMap = [DataValidation::TYPE_NONE => 0x0, DataValidation::TYPE_WHOLE => 0x1, DataValidation::TYPE_DECIMAL => 0x2, DataValidation::TYPE_LIST => 0x3, DataValidation::TYPE_DATE => 0x4, DataValidation::TYPE_TIME => 0x5, DataValidation::TYPE_TEXTLENGTH => 0x6, DataValidation::TYPE_CUSTOM => 0x7];
    /**
     * @var array<string, int>
     */
    protected static array $errorStyleMap = [DataValidation::STYLE_STOP => 0x0, DataValidation::STYLE_WARNING => 0x1, DataValidation::STYLE_INFORMATION => 0x2];
    /**
     * @var array<string, int>
     */
    protected static array $operatorMap = [DataValidation::OPERATOR_BETWEEN => 0x0, DataValidation::OPERATOR_NOTBETWEEN => 0x1, DataValidation::OPERATOR_EQUAL => 0x2, DataValidation::OPERATOR_NOTEQUAL => 0x3, DataValidation::OPERATOR_GREATERTHAN => 0x4, DataValidation::OPERATOR_LESSTHAN => 0x5, DataValidation::OPERATOR_GREATERTHANOREQUAL => 0x6, DataValidation::OPERATOR_LESSTHANOREQUAL => 0x7];
    public static function type(DataValidation $dataValidation) : int
    {
        $validationType = $dataValidation->getType();
        return self::$validationTypeMap[$validationType] ?? self::$validationTypeMap[DataValidation::TYPE_NONE];
    }
    public static function errorStyle(DataValidation $dataValidation) : int
    {
        $errorStyle = $dataValidation->getErrorStyle();
        return self::$errorStyleMap[$errorStyle] ?? self::$errorStyleMap[DataValidation::STYLE_STOP];
    }
    public static function operator(DataValidation $dataValidation) : int
    {
        $operator = $dataValidation->getOperator();
        return self::$operatorMap[$operator] ?? self::$operatorMap[DataValidation::OPERATOR_BETWEEN];
    }
}
