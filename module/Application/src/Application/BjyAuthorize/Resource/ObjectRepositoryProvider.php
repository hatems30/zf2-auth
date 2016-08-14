<?php
/**
 * BjyAuthorize Module (https://github.com/bjyoungblood/BjyAuthorize)
 *
 * @link https://github.com/bjyoungblood/BjyAuthorize for the canonical source repository
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\BjyAuthorize\Resource;

use BjyAuthorize\Acl\Resource;
use BjyAuthorize\Acl\HierarchicalResourceInterface;
use Doctrine\Common\Persistence\ObjectRepository;
use Zend\Permissions\Acl\Resource\ResourceInterface;

/**
 * Resource provider based on a {@see \Doctrine\Common\Persistence\ObjectRepository}
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class ObjectRepositoryProvider implements \BjyAuthorize\Provider\Resource\ProviderInterface
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    protected $objectRepository;

    /**
     * @param \Doctrine\Common\Persistence\ObjectRepository $objectRepository
     */
    public function __construct(ObjectRepository $objectRepository)
    {
        $this->objectRepository = $objectRepository;
    }

    /**
     * {@inheritDoc}
     */
    public function getResources()
    {
        $result = $this->objectRepository->findAll();
        $array  = array();

        // Pass One: Build each object
        foreach ($result as $v) {
           $array[]=$v->getName();
        }

      
        return array_values($array);
    }
}
