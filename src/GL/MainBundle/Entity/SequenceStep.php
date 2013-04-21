<?php

namespace GL\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SequenceStep
 *
 * @ORM\Table(name="sequence_step")
 * @ORM\Entity(repositoryClass="GL\MainBundle\Entity\SequenceStepRepository")
 */
class SequenceStep
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
   * @ORM\Column(name="pattern", type="text", nullable=true)
   */
  private $pattern;

  /**
   * @ORM\OneToMany(targetEntity="ProcessEvent", mappedBy="step")
   */
  private $processEvents;

  /**
   * Constructor
   */
  public function __construct()
  {
    $this->processEvents = new \Doctrine\Common\Collections\ArrayCollection();
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
   * @return SequenceStep
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
   * Add processEvents
   *
   * @param \GL\MainBundle\Entity\ProcessEvent $processEvents
   * @return SequenceStep
   */
  public function addProcessEvent(\GL\MainBundle\Entity\ProcessEvent $processEvents)
  {
    $this->processEvents[] = $processEvents;
  
    return $this;
  }

  /**
   * Remove processEvents
   *
   * @param \GL\MainBundle\Entity\ProcessEvent $processEvents
   */
  public function removeProcessEvent(\GL\MainBundle\Entity\ProcessEvent $processEvents)
  {
    $this->processEvents->removeElement($processEvents);
  }

  /**
   * Get processEvents
   *
   * @return \Doctrine\Common\Collections\Collection 
   */
  public function getProcessEvents()
  {
    return $this->processEvents;
  }

  /**
   * Set pattern
   *
   * @param string $pattern
   * @return SequenceStep
   */
  public function setPattern($pattern)
  {
    $this->pattern = $pattern;
  
    return $this;
  }

  /**
   * Get pattern
   *
   * @return string 
   */
  public function getPattern()
  {
    return $this->pattern;
  }
}