<?php

declare (strict_types=1);
namespace OCA\Tables\Vendor\Composer\Pcre\PHPStan;

use OCA\Tables\Vendor\Composer\Pcre\Preg;
use OCA\Tables\Vendor\Composer\Pcre\Regex;
use OCA\Tables\Vendor\PhpParser\Node\Expr\StaticCall;
use OCA\Tables\Vendor\PHPStan\Analyser\Scope;
use OCA\Tables\Vendor\PHPStan\Reflection\MethodReflection;
use OCA\Tables\Vendor\PHPStan\Reflection\Native\NativeParameterReflection;
use OCA\Tables\Vendor\PHPStan\Reflection\ParameterReflection;
use OCA\Tables\Vendor\PHPStan\TrinaryLogic;
use OCA\Tables\Vendor\PHPStan\Type\ClosureType;
use OCA\Tables\Vendor\PHPStan\Type\Constant\ConstantArrayType;
use OCA\Tables\Vendor\PHPStan\Type\Php\RegexArrayShapeMatcher;
use OCA\Tables\Vendor\PHPStan\Type\StaticMethodParameterClosureTypeExtension;
use OCA\Tables\Vendor\PHPStan\Type\StringType;
use OCA\Tables\Vendor\PHPStan\Type\TypeCombinator;
use OCA\Tables\Vendor\PHPStan\Type\Type;
/** @internal */
final class PregReplaceCallbackClosureTypeExtension implements StaticMethodParameterClosureTypeExtension
{
    /**
     * @var RegexArrayShapeMatcher
     */
    private $regexShapeMatcher;
    public function __construct(RegexArrayShapeMatcher $regexShapeMatcher)
    {
        $this->regexShapeMatcher = $regexShapeMatcher;
    }
    public function isStaticMethodSupported(MethodReflection $methodReflection, ParameterReflection $parameter) : bool
    {
        return \in_array($methodReflection->getDeclaringClass()->getName(), [Preg::class, Regex::class], \true) && \in_array($methodReflection->getName(), ['replaceCallback', 'replaceCallbackStrictGroups'], \true) && $parameter->getName() === 'replacement';
    }
    public function getTypeFromStaticMethodCall(MethodReflection $methodReflection, StaticCall $methodCall, ParameterReflection $parameter, Scope $scope) : ?Type
    {
        $args = $methodCall->getArgs();
        $patternArg = $args[0] ?? null;
        $flagsArg = $args[5] ?? null;
        if ($patternArg === null) {
            return null;
        }
        $flagsType = PregMatchFlags::getType($flagsArg, $scope);
        $matchesType = $this->regexShapeMatcher->matchExpr($patternArg->value, $flagsType, TrinaryLogic::createYes(), $scope);
        if ($matchesType === null) {
            return null;
        }
        if ($methodReflection->getName() === 'replaceCallbackStrictGroups' && \count($matchesType->getConstantArrays()) === 1) {
            $matchesType = $matchesType->getConstantArrays()[0];
            $matchesType = new ConstantArrayType($matchesType->getKeyTypes(), \array_map(static function (Type $valueType) : Type {
                if (\count($valueType->getConstantArrays()) === 1) {
                    $valueTypeArray = $valueType->getConstantArrays()[0];
                    return new ConstantArrayType($valueTypeArray->getKeyTypes(), \array_map(static function (Type $valueType) : Type {
                        return TypeCombinator::removeNull($valueType);
                    }, $valueTypeArray->getValueTypes()), $valueTypeArray->getNextAutoIndexes(), [], $valueTypeArray->isList());
                }
                return TypeCombinator::removeNull($valueType);
            }, $matchesType->getValueTypes()), $matchesType->getNextAutoIndexes(), [], $matchesType->isList());
        }
        return new ClosureType([new NativeParameterReflection($parameter->getName(), $parameter->isOptional(), $matchesType, $parameter->passedByReference(), $parameter->isVariadic(), $parameter->getDefaultValue())], new StringType());
    }
}
