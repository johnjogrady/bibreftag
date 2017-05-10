<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Ref;
use AppBundle\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;

/**
 * Ref controller.
 *
 * @Route("ref")
 */
class RefController extends Controller
{
    /**
     * Lists all public ref entities.
     *
     * @Route("/", name="ref_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $refs = $em->getRepository('AppBundle:Ref')->findByIsPublic(true);
        $tagsForRef=[];
        foreach ($refs as $refItem)
        {
            $refTags[$refItem->getId()]= $em->getRepository('AppBundle:RefTag')->findByRefId($refItem->getId());
        }

        return $this->render('ref/index.html.twig', array(
            'refs' => $refs,

        ));
    }

    /**
     * Lists all Ref entities which match query term passed in as request
     *
     * @Route("/ref_search", name="ref_search")
     * @Method("GET")
     */
    public function searchAction()
    {
        $em = $this->getDoctrine()->getManager();
        $request = ($_REQUEST);
        $queryTerm=$request['query'];
        $refs= $em->createQuery("SELECT o FROM AppBundle:Ref o WHERE o.refName like :searchterm")
            ->setParameter('searchterm', '%'.$queryTerm.'%')->getResult();
        return $this->render('ref/index.html.twig', array(
            'refs' => $refs,
            'description'=>'Refs containing: '.$queryTerm
        ));
    }


    /**
     * Lists all ref entities which match query term passed in as request
     *
     * @Route("/ref_search_by_date", name="ref_search_by_date")
     * @Method("GET")
     */
    public function searchbyDateAction()
    {
        $em = $this->getDoctrine()->getManager();
        $request = ($_REQUEST);
        $fromDate = new \DateTime($request['fromDate']);
        $toDate = new \DateTime($request['toDate']);

        $refs= $em->createQuery("SELECT o FROM AppBundle:Ref o WHERE o.lastEditDate >= :fromDate AND o.lastEditDate <= :toDate")
            ->setParameter('fromDate', $fromDate)
            ->setParameter('toDate', $toDate)
            ->getResult();
        return $this->render('ref/index.html.twig', array(
            'refs' => $refs,
            'description'=>'Refs entered between: '.$fromDate->format('d-m-Y').' and '.$toDate->format('d-m-Y')

        ));
    }
    /**
     * Ref controller.
     *
     * @Route("ref")
     */
    /**
     * Lists all public ref entities. for user
     *
     * @Route("/ref/my", name="myref_index")
     * @Method("GET")
     */
    public function myRefIndexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $authenticationUtils = $this->get('security.authentication_utils')->getLastUsername();
        $user = $em->getRepository('AppBundle:User')->findByEmail($authenticationUtils);
        $refs = $em->getRepository('AppBundle:Ref')->findByOwnerId($user);


        $tagsForRef=[];
        foreach ($refs as $refItem)
        {
            $refTags[$refItem->getId()]= $em->getRepository('AppBundle:RefTag')->findByRefId($refItem->getId());
        }


        return $this->render('ref/index.html.twig', array(
            'refs' => $refs,
            'refTags'=>$refTags

        ));
    }


    /**
     * Ref controller.
     *
     * @Route("ref")
     */
    /**
     * Lists all public ref entities.
     *
     * @Route("/ref/approve", name="approve_ref_index")
     * @Method("GET")
     */
    public function suggestedRefsIndexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $authenticationUtils = $this->get('security.authentication_utils')->getLastUsername();
        $user = $em->getRepository('AppBundle:User')->findByEmail($authenticationUtils);
        $refs = $em->getRepository('AppBundle:Ref')->findByIsConfirmed(false);


        $tagsForRef=[];
        foreach ($refs as $refItem)
        {
            $refTags[$refItem->getId()]= $em->getRepository('AppBundle:RefTag')->findByRefId($refItem->getId());
        }


        return $this->render('ref/index.html.twig', array(
            'refs' => $refs,
            'refTags'=>$refTags

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
     * Submite a new ref entity as pending.
     *
     * @Route("/submit", name="ref_submit")
     * @Method({"GET", "POST"})
     */
    public function submitAction(Request $request)
    {
        $ref = new Ref();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm('AppBundle\Form\RefSubmitType', $ref);
        $authenticationUtils = $this->get('security.authentication_utils')->getLastUsername();
        $user = $em->getRepository('AppBundle:User')->findByEmail($authenticationUtils);
        $refs = $em->getRepository('AppBundle:Ref')->findByOwnerId($user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $ref->setIsConfirmed(false);
            $ref->setIsPublic(false);

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
        $em = $this->getDoctrine()->getManager();

        $reftags = $em->getRepository('AppBundle:RefTag')->findByRefId($ref->getId());
        $bibRefs = $em->getRepository('AppBundle:BibRef')->findByRefId($ref->getId());

        $tags = $em->getRepository('AppBundle:Tag');

        foreach ($reftags as  $reftag)
        {
            $reftags += $tags->findById($reftag->getTagId());
        }

        return $this->render('ref/show.html.twig', array(
            'ref' => $ref,
            'bibRefs'=>$bibRefs,
            'refTags'=>$reftags,
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
        $session = $request->getSession();
        $session->start();
        $em = $this->getDoctrine()->getManager();

        $authenticationUtils = $this->get('security.authentication_utils')->getLastUsername();
        $user = $em->getRepository('AppBundle:User')->findByEmail($authenticationUtils);



        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            var_dump('success');

            return $this->redirectToRoute('ref_edit', array('id' => $ref->getId()));
        }
        if (['REQUEST_METHOD'] === 'POST') {
            $session->getFlashBag('error');
            $session->getFlashBag()->add('error', 'Sorry, you cannot edit References that belong to other people!');
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
