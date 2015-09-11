<?php
/**
 * Created by PhpStorm.
 * User: jderay
 * Date: 9/11/15
 * Time: 11:09 AM
 */

namespace Giftcards\EncryptionBundle\CipherText\Rotator\Factory;

use Giftcards\Encryption\CipherText\Rotator\Factory\DatabaseTableRotatorBuilder as BaseDatabaseTableRotatorBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DatabaseTableRotatorBuilder extends BaseDatabaseTableRotatorBuilder
{
    protected $container;

    /**
     * DatabaseTableRotatorBuilder constructor.
     * @param $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function configureOptionsResolver(OptionsResolver $resolver)
    {
        $container = $this->container;
        parent::configureOptionsResolver($resolver);
        $resolver
            ->addAllowedTypes(array('pdo' => 'string'))
            ->setNormalizers(array('pdo' => function ($_, $pdo) use ($container) {
                if ($pdo instanceof \PDO) {
                    return $pdo;
                }
                
                return $this->container->get($pdo);
            }))
        ;
    }
}
