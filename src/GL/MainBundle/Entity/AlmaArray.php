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
   * @var string
   *
   * @ORM\Column(name="code", type="string", length=255)
   */
  private $code;

  /**
   * @ORM\OneToMany(targetEntity="Process", mappedBy="almaArray")
   */
  private $processes;

  /**
   * Constructor
   */
  public function __construct()
  {
    $this->processes = new \Doctrine\Common\Collections\ArrayCollection();
  }

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
  
  /**
   * Set code
   *
   * @param string $code
   * @return AlmaArray
   */
  public function setCode($code)
  {
    $this->code = $code;
  
    return $this;
  }

  /**
   * Get code
   *
   * @return string 
   */
  public function getCode()
  {
    return $this->code;
  }

  /**
   * Add processes
   *
   * @param \GL\MainBundle\Entity\Process $processes
   * @return AlmaArray
   */
  public function addProcesse(\GL\MainBundle\Entity\Process $processes)
  {
    $this->processes[] = $processes;
  
    return $this;
  }

  /**
   * Remove processes
   *
   * @param \GL\MainBundle\Entity\Process $processes
   */
  public function removeProcesse(\GL\MainBundle\Entity\Process $processes)
  {
    $this->processes->removeElement($processes);
  }

  /**
   * Get processes
   *
   * @return \Doctrine\Common\Collections\Collection 
   */
  public function getProcesses()
  {
    return $this->processes;
  }
}