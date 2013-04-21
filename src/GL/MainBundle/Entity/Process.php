<?php

namespace GL\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Process
 *
 * @ORM\Table(name="process")
 * @ORM\Entity(repositoryClass="GL\MainBundle\Entity\ProcessRepository")
 */
class Process
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
   * @ORM\ManyToOne(targetEntity="AlmaArray", inversedBy="processes")
   * @ORM\JoinColumn(name="alma_array_id", referencedColumnName="id")
   */
  private $almaArray;

  /**
   * @ORM\ManyToOne(targetEntity="Sequence", inversedBy="processes")
   * @ORM\JoinColumn(name="sequence_id", referencedColumnName="id")
   */
  private $sequence;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="start_date", type="datetime")
   */
  private $startDate;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="end_date", type="datetime", nullable=true)
   */
  private $endDate;

  /**
   * @ORM\OneToMany(targetEntity="ProcessEvent", mappedBy="process")
   */
  private $events;

  /**
   * Constructor
   */
  public function __construct()
  {
    $this->events = new \Doctrine\Common\Collections\ArrayCollection();
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
   * Set startDate
   *
   * @param \DateTime $startDate
   * @return Process
   */
  public function setStartDate($startDate)
  {
    $this->startDate = $startDate;
  
    return $this;
  }

  /**
   * Get startDate
   *
   * @return \DateTime 
   */
  public function getStartDate()
  {
    return $this->startDate;
  }

  /**
   * Set endDate
   *
   * @param \DateTime $endDate
   * @return Process
   */
  public function setEndDate($endDate)
  {
    $this->endDate = $endDate;
  
    return $this;
  }

  /**
   * Get endDate
   *
   * @return \DateTime 
   */
  public function getEndDate()
  {
    return $this->endDate;
  }
  
  /**
   * Set almaArray
   *
   * @param \GL\MainBundle\Entity\AlmaArray $almaArray
   * @return Process
   */
  public function setAlmaArray(\GL\MainBundle\Entity\AlmaArray $almaArray = null)
  {
    $this->almaArray = $almaArray;
  
    return $this;
  }

  /**
   * Get almaArray
   *
   * @return \GL\MainBundle\Entity\AlmaArray 
   */
  public function getAlmaArray()
  {
    return $this->almaArray;
  }

  /**
   * Set sequence
   *
   * @param \GL\MainBundle\Entity\Sequence $sequence
   * @return Process
   */
  public function setSequence(\GL\MainBundle\Entity\Sequence $sequence = null)
  {
    $this->sequence = $sequence;
  
    return $this;
  }

  /**
   * Get sequence
   *
   * @return \GL\MainBundle\Entity\Sequence 
   */
  public function getSequence()
  {
    return $this->sequence;
  }

  /**
   * Add events
   *
   * @param \GL\MainBundle\Entity\ProcessEvent $events
   * @return Process
   */
  public function addEvent(\GL\MainBundle\Entity\ProcessEvent $events)
  {
    $this->events[] = $events;
  
    return $this;
  }

  /**
   * Remove events
   *
   * @param \GL\MainBundle\Entity\ProcessEvent $events
   */
  public function removeEvent(\GL\MainBundle\Entity\ProcessEvent $events)
  {
    $this->events->removeElement($events);
  }

  /**
   * Get events
   *
   * @return \Doctrine\Common\Collections\Collection 
   */
  public function getEvents()
  {
    return $this->events;
  }
}