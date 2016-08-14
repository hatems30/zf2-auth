<?php
/**
 * BjyAuthorize Module (https://github.com/bjyoungblood/BjyAuthorize)
 *
 * @link https://github.com/bjyoungblood/BjyAuthorize for the canonical source repository
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\BjyAuthorize\Resource;

use BjyAuthorize\Exception\InvalidArgumentException;
use Application\BjyAuthorize\Resource\ObjectRepositoryProvider;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Factory responsible of instantiating {@see \BjyAuthorize\Provider\Role\ObjectRepositoryProvider}
 *
 * @author Tom Oram <tom@scl.co.uk>
 * @author Jérémy Huet <jeremy.huet@gmail.com>
 */
class ObjectRepositoryResourceProviderFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return \BjyAuthorize\Provider\Resource\ObjectRepositoryProvider
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('BjyAuthorize\Config');

      
       
        if (! isset($config['resource_providers']['Application\BjyAuthorize\Resource\ObjectRepositoryProvider'])) {
            throw new InvalidArgumentException(
                'Config for "Application\BjyAuthorize\Resource\ObjectRepositoryProvider" not set'
            );
        }

        $providerConfig = $config['resource_providers']['Application\BjyAuthorize\Resource\ObjectRepositoryProvider'];

        if (! isset($providerConfig['resource_entity_class'])) {
            throw new InvalidArgumentException('resource_entity_class not set in the bjyauthorize role_providers config.');
        }

        if (! isset($providerConfig['object_manager'])) {
            throw new InvalidArgumentException('object_manager not set in the bjyauthorize role_providers config.');
        }

        /* @var $objectManager \Doctrine\Common\Persistence\ObjectManager */
        $objectManager = $serviceLocator->get($providerConfig['object_manager']);

        return new ObjectRepositoryProvider($objectManager->getRepository($providerConfig['resource_entity_class']));
    }
}
