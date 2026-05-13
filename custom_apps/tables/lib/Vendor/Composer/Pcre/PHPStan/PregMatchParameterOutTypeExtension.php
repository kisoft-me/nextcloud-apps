<?php

declare (strict_types=1);
namespace OCA\Tables\Vendor\Composer\Pcre\PHPStan;

use OCA\Tables\Vendor\Composer\Pcre\Preg;
use OCA\Tables\Vendor\PhpParser\Node\Expr\StaticCall;
use OCA\Tables\Vendor\PHPStan\Analyser\Scope;
use OCA\Tables\Vendor\PHPStan\Reflection\MethodReflection;
use OCA\Tables\Vendor\PHPStan\Reflection\ParameterReflection;
use OCA\Tables\Vendor\PHPStan\TrinaryLogic;
use OCA\Tables\Vendor\PHPStan\Type\Php\RegexArrayShapeMatcher;
use OCA\Tables\Vendor\PHPStan\Type\StaticMethodParameterOutTypeExtension;
use OCA\Tables\Vendor\PHPStan\Type\Type;
/** @internal */
final class PregMatchParameterOutTypeExtension implements StaticMethodParameterOutTypeExtension
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
        return $methodReflection->getDeclaringClass()->getName() === Preg::class && \in_array($methodReflection->getName(), ['match', 'isMatch', 'matchStrictGroups', 'isMatchStrictGroups', 'matchAll', 'isMatchAll', 'matchAllStrictGroups', 'isMatchAllStrictGroups'], \true) && $parameter->getName() === 'matches';
    }
    public function getParameterOutTypeFromStaticMethodCall(MethodReflection $methodReflection, StaticCall $methodCall, ParameterReflection $parameter, Scope $scope) : ?Type
    {
        $args = $methodCall->getArgs();
        $patternArg = $args[0] ?? null;
        $matchesArg = $args[2] ?? null;
        $flagsArg = $args[3] ?? null;
        if ($patternArg === null || $matchesArg === null) {
            return null;
        }
        $flagsType = PregMatchFlags::getType($flagsArg, $scope);
        if ($flagsType === null) {
            return null;
        }
        if (\stripos($methodReflection->getName(), 'matchAll') !== \false) {
            return $this->regexShapeMatcher->matchAllExpr($patternArg->value, $flagsType, TrinaryLogic::createMaybe(), $scope);
        }
        return $this->regexShapeMatcher->matchExpr($patternArg->value, $flagsType, TrinaryLogic::createMaybe(), $scope);
    }
}
