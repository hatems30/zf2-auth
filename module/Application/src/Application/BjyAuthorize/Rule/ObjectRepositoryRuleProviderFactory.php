<?php
/**
 * BjyAuthorize Module (https://github.com/bjyoungblood/BjyAuthorize)
 *
 * @link https://github.com/bjyoungblood/BjyAuthorize for the canonical source repository
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\BjyAuthorize\Rule;

use BjyAuthorize\Exception\InvalidArgumentException;
use Application\BjyAuthorize\Rule\ObjectRepositoryProvider;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Factory responsible of instantiating {@see \BjyAuthorize\Provider\Role\ObjectRepositoryProvider}
 *
 * @author Tom Oram <tom@scl.co.uk>
 * @author Jérémy Huet <jeremy.huet@gmail.com>
 */
class ObjectRepositoryRuleProviderFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return \BjyAuthorize\Provider\Rule\ObjectRepositoryProvider
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('BjyAuthorize\Config');
     
      
       
        if (! isset($config['rule_providers']['Application\BjyAuthorize\Rule\ObjectRepositoryProvider'])) {
            throw new InvalidArgumentException(
                'Config for "Application\BjyAuthorize\Rule\ObjectRepositoryProvider" not set'
            );
        }
        
   

        $providerConfig = $config['rule_providers']['Application\BjyAuthorize\Rule\ObjectRepositoryProvider'];
;
        if (! isset($providerConfig['rule_entity_class'])) {
            throw new InvalidArgumentException('rule_entity_class not set in the bjyauthorize role_providers config.');
        }

        if (! isset($providerConfig['object_manager'])) {
            throw new InvalidArgumentException('object_manager not set in the bjyauthorize role_providers config.');
        }

        /* @var $objectManager \Doctrine\Common\Persistence\ObjectManager */
        $objectManager = $serviceLocator->get($providerConfig['object_manager']);

        return new ObjectRepositoryProvider($objectManager->getRepository($providerConfig['rule_entity_class']));
    }
}
