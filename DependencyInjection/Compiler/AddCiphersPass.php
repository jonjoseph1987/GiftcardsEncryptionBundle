<?php
/**
 * Created by PhpStorm.
 * User: jderay
 * Date: 8/3/15
 * Time: 7:58 PM
 */

namespace Omni\EncryptionBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class AddCiphersPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('omni.encryption.cipher.registry')) {
            return;
        }
        
        $registry = $container->getDefinition('omni.encryption.cipher.registry');

        foreach ($container->findTaggedServiceIds('omni.encryption.cipher') as $id => $tags) {
            if (count($tags) > 1) {
                throw new \InvalidArgumentException(sprintf(
                    'The service "%s" tagged omni.encryption.cipher must have only one of those tags %d were found.',
                    $id,
                    count($tags)
                ));
            }
            $tag = $tags[0];
            if (!isset($tag['alias'])) {
                throw new \InvalidArgumentException(sprintf(
                    'The service "%s" tagged omni.encryption.cipher must have an "alias" key given.',
                    $id
                ));
            }
            $registry->addMethodCall('setServiceId', array($tag['alias'], $id));        }
    }
}