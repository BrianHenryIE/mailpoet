<?php

namespace MailPoet\Test\Doctrine;

use MailPoetVendor\Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="test_entity")
 */
class Entity {
  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue
   * @var int|null
   */
  private $id;

  /**
   * @ORM\Column(type="string")
   * @var string
   */
  private $name;

  /**
   * @return int|null
   */
  function getId() {
    return $this->id;
  }

  /** @return string */
  function getName() {
    return $this->name;
  }
  /** @param string $name */
  function setName($name) {
    $this->name = $name;
  }
}
