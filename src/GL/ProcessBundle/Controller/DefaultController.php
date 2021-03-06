<?php

namespace GL\ProcessBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
/**
 * @Route("/processes")
 */
class DefaultController extends Controller
{
  /**
   * @Route("/", name="processes")
   * @Template()
   */
  public function indexAction()
  {
    $em = $this->getDoctrine()->getEntityManager();

    $query = '
    SELECT p.id, a.name, p.start_date, p.end_date, e.step_id, e.step_name, e.status
    FROM process p
    INNER JOIN alma_array a ON p.alma_array_id = a.id
    LEFT OUTER JOIN
    (
       SELECT e.process_id,e.step_id,s.name as \'step_name\',e.status
       FROM process_event e
       INNER JOIN sequence_step s ON e.step_id = s.id
       INNER JOIN
       (
               SELECT MAX(p.id) as \'event_id\'
               FROM process_event p
               GROUP by p.process_id
       ) ee ON e.id = ee.event_id
    ) e ON p.id = e.process_id
    ORDER BY p.id DESC
    ';

    $processes = $em->getConnection()->fetchAll($query);

    return array(
      'processes' => $processes,
    );
  }

  /**
   * @Route("/{id}/detail", name="process_detail")
   * @Template()
   */
  public function detailAction($id)
  {
    $em = $this->getDoctrine()->getEntityManager();
    $event = $em->getRepository('GLMainBundle:ProcessEvent')
    ->createQueryBuilder('e')
    ->where('e.process = :process')
    ->setParameter('process', $id)
    ->orderBy('e.step', 'ASC')
    ->getQuery()
    ->getResult()
    ;

    return array(
      'id'    => $id,
      'event' => $event,
    );
  }

  /**
   * @Route("/{id}/event_detail", name="event_detail")
   * @Template()
   */
  public function eventDetailAction($id)
  {
    $em = $this->getDoctrine()->getEntityManager();
    $event = $em->getRepository('GLMainBundle:ProcessEvent')->find($id);

    $details = $em->getRepository('GLMainBundle:ProcessEventDetail')
    ->createQueryBuilder('ed')
    ->where('ed.event = :event')
    ->setParameter('event', $id)
    ->getQuery()
    ->getResult()
    ;

    return array(
      'event' => $event, 
      'details' => $details,
    );
  }
}
