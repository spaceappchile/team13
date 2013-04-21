<?php

namespace GL\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProcessEvent
 *
 * @ORM\Table(name="process_event")
 * @ORM\Entity(repositoryClass="GL\MainBundle\Entity\ProcessEventRepository")
 */
class ProcessEvent
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
   * @ORM\ManyToOne(targetEntity="Process", inversedBy="events")
   * @ORM\JoinColumn(name="process_id", referencedColumnName="id")
   */
  private $process;

  /**
   * @ORM\ManyToOne(targetEntity="SequenceStep", inversedBy="processEvents")
   * @ORM\JoinColumn(name="step_id", referencedColumnName="id")
   */
  private $step;

  /**
   * @var integer
   *
   * @ORM\Column(name="status", type="smallint")
   */
  private $status;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="execution_date", type="datetime")
   */
  private $executionDate;

  /**
   * @ORM\OneToMany(targetEntity="ProcessEventDetail", mappedBy="event")
   */
  private $details;

  /**
   * Constructor
   */
  public function __construct()
  {
    $this->details = new \Doctrine\Common\Collections\ArrayCollection();
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
   * Set process
   *
   * @param integer $process
   * @return ProcessEvent
   */
  public function setProcess($process)
  {
    $this->process = $process;
  
    return $this;
  }

  /**
   * Get process
   *
   * @return integer 
   */
  public function getProcess()
  {
    return $this->process;
  }

  /**
   * Set step
   *
   * @param integer $step
   * @return ProcessEvent
   */
  public function setStep($step)
  {
    $this->step = $step;
  
    return $this;
  }

  /**
   * Get step
   *
   * @return integer 
   */
  public function getStep()
  {
    return $this->step;
  }

  /**
   * Set status
   *
   * @param integer $status
   * @return ProcessEvent
   */
  public function setStatus($status)
  {
    $this->status = $status;
  
    return $this;
  }

  /**
   * Get status
   *
   * @return integer 
   */
  public function getStatus()
  {
    return $this->status;
  }

  /**
   * Set executionDate
   *
   * @param \DateTime $executionDate
   * @return ProcessEvent
   */
  public function setExecutionDate($executionDate)
  {
    $this->executionDate = $executionDate;
  
    return $this;
  }

  /**
   * Get executionDate
   *
   * @return \DateTime 
   */
  public function getExecutionDate()
  {
    return $this->executionDate;
  }
  
  /**
   * Add details
   *
   * @param \GL\MainBundle\Entity\ProcessEventDetail $details
   * @return ProcessEvent
   */
  public function addDetail(\GL\MainBundle\Entity\ProcessEventDetail $details)
  {
    $this->details[] = $details;
  
    return $this;
  }

  /**
   * Remove details
   *
   * @param \GL\MainBundle\Entity\ProcessEventDetail $details
   */
  public function removeDetail(\GL\MainBundle\Entity\ProcessEventDetail $details)
  {
    $this->details->removeElement($details);
  }

  /**
   * Get details
   *
   * @return \Doctrine\Common\Collections\Collection 
   */
  public function getDetails()
  {
    return $this->details;
  }
}