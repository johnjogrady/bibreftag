<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PublicationCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Publicationcategory controller.
 *
 * @Route("publicationcategory")
 */
class PublicationCategoryController extends Controller
{
    /**
     * Lists all publicationCategory entities.
     *
     * @Route("/", name="publicationcategory_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $publicationCategories = $em->getRepository('AppBundle:PublicationCategory')->findAll();

        return $this->render('publicationcategory/index.html.twig', array(
            'publicationCategories' => $publicationCategories,
        ));
    }

    /**
     * Creates a new publicationCategory entity.
     *
     * @Route("/new", name="publicationcategory_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $publicationCategory = new Publicationcategory();
        $form = $this->createForm('AppBundle\Form\PublicationCategoryType', $publicationCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($publicationCategory);
            $em->flush($publicationCategory);

            return $this->redirectToRoute('publicationcategory_show', array('id' => $publicationCategory->getId()));
        }

        return $this->render('publicationcategory/new.html.twig', array(
            'publicationCategory' => $publicationCategory,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a publicationCategory entity.
     *
     * @Route("/{id}", name="publicationcategory_show")
     * @Method("GET")
     */
    public function showAction(PublicationCategory $publicationCategory)
    {
        $deleteForm = $this->createDeleteForm($publicationCategory);

        return $this->render('publicationcategory/show.html.twig', array(
            'publicationCategory' => $publicationCategory,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing publicationCategory entity.
     *
     * @Route("/{id}/edit", name="publicationcategory_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PublicationCategory $publicationCategory)
    {
        $deleteForm = $this->createDeleteForm($publicationCategory);
        $editForm = $this->createForm('AppBundle\Form\PublicationCategoryType', $publicationCategory);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('publicationcategory_edit', array('id' => $publicationCategory->getId()));
        }

        return $this->render('publicationcategory/edit.html.twig', array(
            'publicationCategory' => $publicationCategory,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a publicationCategory entity.
     *
     * @Route("/{id}", name="publicationcategory_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PublicationCategory $publicationCategory)
    {
        $form = $this->createDeleteForm($publicationCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($publicationCategory);
            $em->flush();
        }

        return $this->redirectToRoute('publicationcategory_index');
    }

    /**
     * Creates a form to delete a publicationCategory entity.
     *
     * @param PublicationCategory $publicationCategory The publicationCategory entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PublicationCategory $publicationCategory)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('publicationcategory_delete', array('id' => $publicationCategory->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
