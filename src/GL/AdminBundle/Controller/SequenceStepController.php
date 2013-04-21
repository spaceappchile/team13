<?php

namespace GL\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use GL\MainBundle\Entity\SequenceStep;
use GL\AdminBundle\Form\SequenceStepType;

/**
 * SequenceStep controller.
 *
 * @Route("/admin/sequence_step")
 */
class SequenceStepController extends Controller
{
  /**
   * Lists all SequenceStep entities.
   *
   * @Route("/", name="admin_sequence_step")
   * @Template()
   */
  public function indexAction()
  {
    $em = $this->getDoctrine()->getManager();

    $entities = $em->getRepository('GLMainBundle:SequenceStep')->findAll();

    return array(
      'entities' => $entities,
    );
  }

  /**
   * Displays a form to create a new SequenceStep entity.
   *
   * @Route("/new", name="admin_sequence_step_new")
   * @Template()
   */
  public function newAction()
  {
    $entity = new SequenceStep();
    $form   = $this->createForm(new SequenceStepType(), $entity);

    return array(
      'entity' => $entity,
      'form'   => $form->createView(),
    );
  }

  /**
   * Creates a new SequenceStep entity.
   *
   * @Route("/create", name="admin_sequence_step_create")
   * @Method("POST")
   * @Template("GLAdminBundle:SequenceStep:new.html.twig")
   */
  public function createAction(Request $request)
  {
    $entity  = new SequenceStep();
    $form = $this->createForm(new SequenceStepType(), $entity);
    $form->bind($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($entity);
      $em->flush();

      return $this->redirect($this->generateUrl('admin_sequence_step_edit', array('id' => $entity->getId())));
    }

    return array(
      'entity' => $entity,
      'form'   => $form->createView(),
    );
  }

  /**
   * Displays a form to edit an existing SequenceStep entity.
   *
   * @Route("/{id}/edit", name="admin_sequence_step_edit")
   * @Template()
   */
  public function editAction($id)
  {
    $em = $this->getDoctrine()->getManager();

    $entity = $em->getRepository('GLMainBundle:SequenceStep')->find($id);

    if (!$entity) {
      throw $this->createNotFoundException('Unable to find SequenceStep entity.');
    }

    $editForm = $this->createForm(new SequenceStepType(), $entity);
    $deleteForm = $this->createDeleteForm($id);

    return array(
      'entity'    => $entity,
      'edit_form'   => $editForm->createView(),
      'delete_form' => $deleteForm->createView(),
    );
  }

  /**
   * Edits an existing SequenceStep entity.
   *
   * @Route("/{id}/update", name="admin_sequence_step_update")
   * @Method("POST")
   * @Template("GLAdminBundle:SequenceStep:edit.html.twig")
   */
  public function updateAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $entity = $em->getRepository('GLMainBundle:SequenceStep')->find($id);

    if (!$entity) {
      throw $this->createNotFoundException('Unable to find SequenceStep entity.');
    }

    $deleteForm = $this->createDeleteForm($id);
    $editForm = $this->createForm(new SequenceStepType(), $entity);
    $editForm->bind($request);

    if ($editForm->isValid()) {
      $em->persist($entity);
      $em->flush();

      return $this->redirect($this->generateUrl('admin_sequence_step_edit', array('id' => $id)));
    }

    return array(
      'entity'    => $entity,
      'edit_form'   => $editForm->createView(),
      'delete_form' => $deleteForm->createView(),
    );
  }

  /**
   * Deletes a SequenceStep entity.
   *
   * @Route("/{id}/delete", name="admin_sequence_step_delete")
   * @Method("POST")
   */
  public function deleteAction(Request $request, $id)
  {
    $form = $this->createDeleteForm($id);
    $form->bind($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('GLMainBundle:SequenceStep')->find($id);

      if (!$entity) {
        throw $this->createNotFoundException('Unable to find SequenceStep entity.');
      }

      $em->remove($entity);
      $em->flush();
    }

    return $this->redirect($this->generateUrl('admin_sequence_step'));
  }

  private function createDeleteForm($id)
  {
    return $this->createFormBuilder(array('id' => $id))
      ->add('id', 'hidden')
      ->getForm()
    ;
  }
}
