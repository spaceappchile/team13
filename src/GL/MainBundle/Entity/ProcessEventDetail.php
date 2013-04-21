<?php

namespace GL\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProcessEventDetail
 *
 * @ORM\Table(name="process_event_detail")
 * @ORM\Entity(repositoryClass="GL\MainBundle\Entity\ProcessEventDetailRepository")
 */
class ProcessEventDetail
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
   * @ORM\ManyToOne(targetEntity="ProcessEvent", inversedBy="details")
   * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
   */
  private $event;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="log_date", type="datetime")
   */
  private $log_date;

  /**
   * @var string
   *
   * @ORM\Column(name="data", type="text")
   */
  private $data;


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
   * Set log_date
   *
   * @param \DateTime $logDate
   * @return ProcessEventDetail
   */
  public function setLogDate($logDate)
  {
    $this->log_date = $logDate;
  
    return $this;
  }

  /**
   * Get log_date
   *
   * @return \DateTime 
   */
  public function getLogDate()
  {
    return $this->log_date;
  }

  /**
   * Set data
   *
   * @param string $data
   * @return ProcessEventDetail
   */
  public function setData($data)
  {
    $this->data = $data;
  
    return $this;
  }

  /**
   * Get data
   *
   * @return string 
   */
  public function getData()
  {
    return $this->data;
  }

  /**
   * Set event
   *
   * @param \GL\MainBundle\Entity\Event $event
   * @return ProcessEventDetail
   */
  public function setEvent(\GL\MainBundle\Entity\Event $event = null)
  {
    $this->event = $event;
  
    return $this;
  }

  /**
   * Get event
   *
   * @return \GL\MainBundle\Entity\Event 
   */
  public function getEvent()
  {
    return $this->event;
  }
}