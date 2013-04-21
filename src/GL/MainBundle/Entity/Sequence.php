<?php

namespace GL\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sequence
 *
 * @ORM\Table(name="sequence")
 * @ORM\Entity(repositoryClass="GL\MainBundle\Entity\SequenceRepository")
 */
class Sequence
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
   * @var description
   *
   * @ORM\Column(name="description", type="text", nullable=true)
   */
  private $description;

  /**
   * @ORM\OneToMany(targetEntity="Process", mappedBy="sequence")
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
   * @return Sequence
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
   * Set description
   *
   * @param string $description
   * @return Sequence
   */
  public function setDescription($description)
  {
    $this->description = $description;
  
    return $this;
  }

  /**
   * Get description
   *
   * @return string 
   */
  public function getDescription()
  {
    return $this->description;
  }

  /**
   * Add processes
   *
   * @param \GL\MainBundle\Entity\Process $processes
   * @return Sequence
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