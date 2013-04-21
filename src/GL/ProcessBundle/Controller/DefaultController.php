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
    SELECT p.id, a.name,p.start_date,p.end_date,e.step_id,e.status
    FROM process p
    INNER JOIN 
    ';

    return array();
  }
}
