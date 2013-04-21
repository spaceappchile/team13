<?php

namespace GL\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use GL\MainBundle\Entity\AlmaArray;
use GL\AdminBundle\Form\AlmaArrayType;

/**
 * AlmaArray controller.
 *
 * @Route("/admin/array")
 */
class AlmaArrayController extends Controller
{
  /**
   * Lists all AlmaArray entities.
   *
   * @Route("/", name="admin_array")
   * @Template()
   */
  public function indexAction()
  {
    $em = $this->getDoctrine()->getManager();

    $entities = $em->getRepository('GLMainBundle:AlmaArray')->findAll();

    return array(
      'entities' => $entities,
    );
  }

  /**
   * Displays a form to create a new AlmaArray entity.
   *
   * @Route("/new", name="admin_array_new")
   * @Template()
   */
  public function newAction()
  {
    $entity = new AlmaArray();
    $form   = $this->createForm(new AlmaArrayType(), $entity);

    return array(
      'entity' => $entity,
      'form'   => $form->createView(),
    );
  }

  /**
   * Creates a new AlmaArray entity.
   *
   * @Route("/create", name="admin_array_create")
   * @Method("POST")
   * @Template("GLAdminBundle:AlmaArray:new.html.twig")
   */
  public function createAction(Request $request)
  {
    $entity  = new AlmaArray();
    $form = $this->createForm(new AlmaArrayType(), $entity);
    $form->bind($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($entity);
      $em->flush();

      return $this->redirect($this->generateUrl('admin_array'));
    }

    return array(
      'entity' => $entity,
      'form'   => $form->createView(),
    );
  }

  /**
   * Displays a form to edit an existing AlmaArray entity.
   *
   * @Route("/{id}/edit", name="admin_array_edit")
   * @Template()
   */
  public function editAction($id)
  {
    $em = $this->getDoctrine()->getManager();

    $entity = $em->getRepository('GLMainBundle:AlmaArray')->find($id);

    if (!$entity) {
      throw $this->createNotFoundException('Unable to find AlmaArray entity.');
    }

    $editForm = $this->createForm(new AlmaArrayType(), $entity);
    $deleteForm = $this->createDeleteForm($id);

    return array(
      'entity'    => $entity,
      'edit_form'   => $editForm->createView(),
      'delete_form' => $deleteForm->createView(),
    );
  }

  /**
   * Edits an existing AlmaArray entity.
   *
   * @Route("/{id}/update", name="admin_array_update")
   * @Method("POST")
   * @Template("GLAdminBundle:AlmaArray:edit.html.twig")
   */
  public function updateAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $entity = $em->getRepository('GLMainBundle:AlmaArray')->find($id);

    if (!$entity) {
      throw $this->createNotFoundException('Unable to find AlmaArray entity.');
    }

    $deleteForm = $this->createDeleteForm($id);
    $editForm = $this->createForm(new AlmaArrayType(), $entity);
    $editForm->bind($request);

    if ($editForm->isValid()) {
      $em->persist($entity);
      $em->flush();

      return $this->redirect($this->generateUrl('admin_array_edit', array('id' => $id)));
    }

    return array(
      'entity'    => $entity,
      'edit_form'   => $editForm->createView(),
      'delete_form' => $deleteForm->createView(),
    );
  }

  /**
   * Deletes a AlmaArray entity.
   *
   * @Route("/{id}/delete", name="admin_array_delete")
   * @Method("POST")
   */
  public function deleteAction(Request $request, $id)
  {
    $form = $this->createDeleteForm($id);
    $form->bind($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('GLMainBundle:AlmaArray')->find($id);

      if (!$entity) {
        throw $this->createNotFoundException('Unable to find AlmaArray entity.');
      }

      $em->remove($entity);
      $em->flush();
    }

    return $this->redirect($this->generateUrl('admin_array'));
  }

  private function createDeleteForm($id)
  {
    return $this->createFormBuilder(array('id' => $id))
      ->add('id', 'hidden')
      ->getForm()
    ;
  }
}
