<?php

declare(strict_types=1);

namespace OCA\Talk\Vendor\CuyZ\Valinor\Definition\Repository\Cache;

use OCA\Talk\Vendor\CuyZ\Valinor\Cache\Cache;
use OCA\Talk\Vendor\CuyZ\Valinor\Cache\CacheEntry;
use OCA\Talk\Vendor\CuyZ\Valinor\Definition\ClassDefinition;
use OCA\Talk\Vendor\CuyZ\Valinor\Definition\Repository\Cache\Compiler\ClassDefinitionCompiler;
use OCA\Talk\Vendor\CuyZ\Valinor\Definition\Repository\ClassDefinitionRepository;
use OCA\Talk\Vendor\CuyZ\Valinor\Type\ObjectType;
use OCA\Talk\Vendor\CuyZ\Valinor\Utility\Reflection\Reflection;

use function is_string;

/** @internal */
final class CompiledClassDefinitionRepository implements ClassDefinitionRepository
{
    public function __construct(
        private ClassDefinitionRepository $delegate,
        /** @var Cache<ClassDefinition> */
        private Cache $cache,
        private ClassDefinitionCompiler $compiler,
    ) {}

    public function for(ObjectType $type): ClassDefinition
    {
        // @infection-ignore-all
        $key = "class-definition-\0" . $type->toString();

        $entry = $this->cache->get($key);

        if ($entry) {
            return $entry;
        }

        $class = $this->delegate->for($type);

        $code = 'fn () => ' . $this->compiler->compile($class);
        $filesToWatch = $this->filesToWatch($type);

        $this->cache->set($key, new CacheEntry($code, $filesToWatch));

        /** @var ClassDefinition */
        return $this->cache->get($key);
    }

    /**
     * @return list<non-empty-string>
     */
    private function filesToWatch(ObjectType $type): array
    {
        $reflection = Reflection::class($type->className());

        $fileNames = [];

        do {
            $fileName = $reflection->getFileName();

            if (is_string($fileName)) {
                $fileNames[] = $fileName;
            }
        } while ($reflection = $reflection->getParentClass());

        return $fileNames;
    }
}
