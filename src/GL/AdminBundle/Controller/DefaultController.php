<?php

namespace GL\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
/**
 * @Route("/admin")
 */
class DefaultController extends Controller
{
  /**
   * @Route("/", name="admin")
   * @Template()
   */
  public function indexAction()
  {
    return array();
  }
}
