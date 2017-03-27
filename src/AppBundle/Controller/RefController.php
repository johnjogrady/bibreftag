<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Ref;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Ref controller.
 *
 * @Route("ref")
 */
class RefController extends Controller
{
    /**
     * Lists all ref entities.
     *
     * @Route("/", name="ref_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $refs = $em->getRepository('AppBundle:Ref')->findAll();

        return $this->render('ref/index.html.twig', array(
            'refs' => $refs,
        ));
    }

    /**
     * Creates a new ref entity.
     *
     * @Route("/new", name="ref_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ref = new Ref();
        $form = $this->createForm('AppBundle\Form\RefType', $ref);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ref);
            $em->flush($ref);

            return $this->redirectToRoute('ref_show', array('id' => $ref->getId()));
        }

        return $this->render('ref/new.html.twig', array(
            'ref' => $ref,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ref entity.
     *
     * @Route("/{id}", name="ref_show")
     * @Method("GET")
     */
    public function showAction(Ref $ref)
    {
        $deleteForm = $this->createDeleteForm($ref);

        return $this->render('ref/show.html.twig', array(
            'ref' => $ref,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ref entity.
     *
     * @Route("/{id}/edit", name="ref_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Ref $ref)
    {
        $deleteForm = $this->createDeleteForm($ref);
        $editForm = $this->createForm('AppBundle\Form\RefType', $ref);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ref_edit', array('id' => $ref->getId()));
        }

        return $this->render('ref/edit.html.twig', array(
            'ref' => $ref,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ref entity.
     *
     * @Route("/{id}", name="ref_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Ref $ref)
    {
        $form = $this->createDeleteForm($ref);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ref);
            $em->flush();
        }

        return $this->redirectToRoute('ref_index');
    }

    /**
     * Creates a form to delete a ref entity.
     *
     * @param Ref $ref The ref entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Ref $ref)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ref_delete', array('id' => $ref->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
