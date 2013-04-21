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
    return array();
  }
}
