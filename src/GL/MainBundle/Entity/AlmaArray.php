<?php

namespace GL\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AlmaArray
 *
 * @ORM\Table(name="alma_array")
 * @ORM\Entity(repositoryClass="GL\MainBundle\Entity\AlmaArrayRepository")
 */
class AlmaArray
{
  /**
   * @var integer
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @var string
   *
   * @ORM\Column(name="name", type="string", length=255)
   */
  private $name;

  /**
   * @ORM\OneToMany(targetEntity="Process", mappedBy="almaArray")
   */
  private $processes;


  /**
   * Get id
   *
   * @return integer 
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set name
   *
   * @param string $name
   * @return AlmaArray
   */
  public function setName($name)
  {
    $this->name = $name;
  
    return $this;
  }

  /**
   * Get name
   *
   * @return string 
   */
  public function getName()
  {
    return $this->name;
  }
}
