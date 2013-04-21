<?php

namespace GL\InsightsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
/**
 * @Route("/insights")
 */
class DefaultController extends Controller
{
  /**
   * @Route("/", name="insights")
   * @Template()
   */
  public function indexAction()
  {
    $em = $this->getDoctrine()->getEntityManager();

    $query = '
    SELECT e.id, e.status, DATE_FORMAT(e.execution_date,\'%y-%m-%d %H:%i\') as \'execution_date\', COUNT(e.id) as \'count\'
    FROM process_event e 
    WHERE e.status = 1
    GROUP by status, DATE_FORMAT(execution_date,\'%y-%m-%d %H:%i\')
    ';
    $result1 = $em->getConnection()->fetchAll($query);

    $query = '
    SELECT e.id, e.status, DATE_FORMAT(e.execution_date,\'%y-%m-%d %H:%i\') as \'execution_date\', COUNT(e.id) as \'count\'
    FROM process_event e 
    WHERE e.status = 2
    GROUP by status, DATE_FORMAT(execution_date,\'%y-%m-%d %H:%i\')
    ';
    $result2 = $em->getConnection()->fetchAll($query);

    return array(
      'result1' => $result1,
      'result2' => $result2,
    );
  }
}
