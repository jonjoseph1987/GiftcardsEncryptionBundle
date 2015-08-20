<?php

namespace Omni\EncryptionBundle;

use Omni\EncryptionBundle\DependencyInjection\Compiler\AddCipherTextStoresPass;
use Omni\EncryptionBundle\DependencyInjection\Compiler\AddCiphersPass;
use Omni\EncryptionBundle\DependencyInjection\Compiler\AddCipherTextSerializersPass;
use Omni\EncryptionBundle\DependencyInjection\Compiler\AddKeySourcesPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class OmniEncryptionBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container
            ->addCompilerPass(new AddCipherTextStoresPass())
            ->addCompilerPass(new AddCiphersPass())
            ->addCompilerPass(new AddKeySourcesPass())
            ->addCompilerPass(new AddCipherTextSerializersPass())
        ;
    }
}
