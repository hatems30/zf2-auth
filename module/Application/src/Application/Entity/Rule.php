<?php
/**
 * BjyAuthorize Module (https://github.com/bjyoungblood/BjyAuthorize)
 *
 * @link https://github.com/bjyoungblood/BjyAuthorize for the canonical source repository
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * An example entity that represents a role.
 *
 * @ORM\Entity
 * @ORM\Table(name="rule")
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class Rule 
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", name="role_id", length=255, unique=true, nullable=true)
     */
    protected $roleId;
    /**
     * @var string
     * @ORM\Column(type="string", name="resource", length=255, nullable=true)
     */
    protected $resource;
    /**
     * @var string
     * @ORM\Column(type="string", name="perm", length=255, nullable=true)
     */
    protected $perm;
    /**
     * @var string
     * @ORM\Column(type="string", name="act", length=255, nullable=true)
     */
    protected $act;
   
    function getId() {
        return $this->id;
    }

    function getRoleId() {
        return $this->roleId;
    }

    function getResource() {
        return $this->resource;
    }

    function getPerm() {
        return $this->perm;
    }

    function getAct() {
        return $this->act;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setRoleId($roleId) {
        $this->roleId = $roleId;
    }

    function setResource($resource) {
        $this->resource = $resource;
    }

    function setPerm($perm) {
        $this->perm = $perm;
    }

    function setAct($act) {
        $this->act = $act;
    }


}