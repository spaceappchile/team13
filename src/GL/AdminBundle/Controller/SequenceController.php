<?php

namespace GL\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use GL\MainBundle\Entity\Sequence;
use GL\AdminBundle\Form\SequenceType;

/**
 * Sequence controller.
 *
 * @Route("/admin/sequence")
 */
class SequenceController extends Controller
{
  /**
   * Lists all Sequence entities.
   *
   * @Route("/", name="admin_sequence")
   * @Template()
   */
  public function indexAction()
  {
    $em = $this->getDoctrine()->getManager();

    $entities = $em->getRepository('GLMainBundle:Sequence')->findAll();

    return array(
      'entities' => $entities,
    );
  }

  /**
   * Displays a form to create a new Sequence entity.
   *
   * @Route("/new", name="admin_sequence_new")
   * @Template()
   */
  public function newAction()
  {
    $entity = new Sequence();
    $form   = $this->createForm(new SequenceType(), $entity);

    return array(
      'entity' => $entity,
      'form'   => $form->createView(),
    );
  }

  /**
   * Creates a new Sequence entity.
   *
   * @Route("/create", name="admin_sequence_create")
   * @Method("POST")
   * @Template("GLAdminBundle:Sequence:new.html.twig")
   */
  public function createAction(Request $request)
  {
    $entity  = new Sequence();
    $form = $this->createForm(new SequenceType(), $entity);
    $form->bind($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($entity);
      $em->flush();

      return $this->redirect($this->generateUrl('admin_sequence_edit', array('id' => $entity->getId())));
    }

    return array(
      'entity' => $entity,
      'form'   => $form->createView(),
    );
  }

  /**
   * Displays a form to edit an existing Sequence entity.
   *
   * @Route("/{id}/edit", name="admin_sequence_edit")
   * @Template()
   */
  public function editAction($id)
  {
    $em = $this->getDoctrine()->getManager();

    $entity = $em->getRepository('GLMainBundle:Sequence')->find($id);

    if (!$entity) {
      throw $this->createNotFoundException('Unable to find Sequence entity.');
    }

    $editForm = $this->createForm(new SequenceType(), $entity);
    $deleteForm = $this->createDeleteForm($id);

    return array(
      'entity'    => $entity,
      'edit_form'   => $editForm->createView(),
      'delete_form' => $deleteForm->createView(),
    );
  }

  /**
   * Edits an existing Sequence entity.
   *
   * @Route("/{id}/update", name="admin_sequence_update")
   * @Method("POST")
   * @Template("GLAdminBundle:Sequence:edit.html.twig")
   */
  public function updateAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $entity = $em->getRepository('GLMainBundle:Sequence')->find($id);

    if (!$entity) {
      throw $this->createNotFoundException('Unable to find Sequence entity.');
    }

    $deleteForm = $this->createDeleteForm($id);
    $editForm = $this->createForm(new SequenceType(), $entity);
    $editForm->bind($request);

    if ($editForm->isValid()) {
      $em->persist($entity);
      $em->flush();

      return $this->redirect($this->generateUrl('admin_sequence_edit', array('id' => $id)));
    }

    return array(
      'entity'    => $entity,
      'edit_form'   => $editForm->createView(),
      'delete_form' => $deleteForm->createView(),
    );
  }

  /**
   * Deletes a Sequence entity.
   *
   * @Route("/{id}/delete", name="admin_sequence_delete")
   * @Method("POST")
   */
  public function deleteAction(Request $request, $id)
  {
    $form = $this->createDeleteForm($id);
    $form->bind($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('GLMainBundle:Sequence')->find($id);

      if (!$entity) {
        throw $this->createNotFoundException('Unable to find Sequence entity.');
      }

      $em->remove($entity);
      $em->flush();
    }

    return $this->redirect($this->generateUrl('admin_sequence'));
  }

  private function createDeleteForm($id)
  {
    return $this->createFormBuilder(array('id' => $id))
      ->add('id', 'hidden')
      ->getForm()
    ;
  }
}
