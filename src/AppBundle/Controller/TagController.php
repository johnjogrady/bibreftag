<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tag;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Tag controller.
 *
 * @Route("tag")
 */
class TagController extends Controller
{
    /**
     * Lists all tag entities.
     *
     * @Route("/", name="tag_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tags = $em->getRepository('AppBundle:Tag')->findAll();

        return $this->render('tag/index.html.twig', array(
            'tags' => $tags,
            'description'=>'All Tags'

        ));
    }

    /**
     * Lists all tag entities which match query term passed in as request
     *
     * @Route("/tag_search", name="tag_search")
     * @Method("GET")
     */
    public function searchAction()
    {
        $em = $this->getDoctrine()->getManager();
        $request = ($_REQUEST);
        $queryTerm=$request['query'];
        $tags= $em->createQuery("SELECT o FROM AppBundle:Tag o WHERE o.tagName like :searchterm")
            ->setParameter('searchterm', '%'.$queryTerm.'%')->getResult();
        return $this->render('tag/index.html.twig', array(
            'tags' => $tags,
            'description'=>'Tags containing: '.$queryTerm

        ));
    }

    /**
     * Lists all tag entities which match query term passed in as request
     *
     * @Route("/tag_search_by_date", name="tag_search_by_date")
     * @Method("GET")
     */
    public function searchbyDateAction()
    {
        $em = $this->getDoctrine()->getManager();
        $request = ($_REQUEST);
        $fromDate = new \DateTime($request['fromDate']);
        $toDate = new \DateTime($request['toDate']);

        $tags= $em->createQuery("SELECT o FROM AppBundle:Tag o WHERE o.lastEditDate >= :fromDate AND o.lastEditDate <= :toDate")
            ->setParameter('fromDate', $fromDate)
            ->setParameter('toDate', $toDate)
            ->getResult();
        return $this->render('tag/index.html.twig', array(
            'tags' => $tags,
            'description'=>'Tags entered between: '.$fromDate->format('d-m-Y').' and '.$toDate->format('d-m-Y')

        ));
    }
    /**
     * Lists all proposed tag entities.
     *
     * @Route("/proposedindex", name="tag_proposedindex")
     * @Method("GET")
     */
    public function proposedIndexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $criteria = array('confirmed' => 'true');

        $tags = $em->getRepository('AppBundle:Tag')->findBy($criteria);

        return $this->render('tag/index.html.twig', array(
            'tags' => $tags,
            'description'=>'Pending Tags'
        ));
    }


    /**
     * Creates a new tag entity.
     *
     * @Route("/new", name="tag_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tag = new Tag();
        $form = $this->createForm('AppBundle\Form\TagType', $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush($tag);

            return $this->redirectToRoute('tag_show', array('id' => $tag->getId()));
        }

        return $this->render('tag/new.html.twig', array(
            'tag' => $tag,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tag entity.
     *
     * @Route("/{id}", name="tag_show")
     * @Method("GET")
     */
    public function showAction(Tag $tag)
    {
        $deleteForm = $this->createDeleteForm($tag);

        return $this->render('tag/show.html.twig', array(
            'tag' => $tag,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tag entity.
     *
     * @Route("/{id}/edit", name="tag_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tag $tag)
    {
        $deleteForm = $this->createDeleteForm($tag);
        $editForm = $this->createForm('AppBundle\Form\TagType', $tag);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tag_edit', array('id' => $tag->getId()));
        }

        return $this->render('tag/edit.html.twig', array(
            'tag' => $tag,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing tag entity.
     *
     * @Route("/{id}/upvote", name="tag_upvote")
     * @Method({"GET", "POST"})
     */
    public function upVoteAction(Request $request, Tag $tag)
    {
        $em = $this->getDoctrine()->getManager();
        $voteMultiplier=$this->checkUserAuthentication();
        //var_dump($voteMultiplier);
        $tag->setNumVotes($tag->getNumVotes()+1*$voteMultiplier);
        $this->getDoctrine()->getManager()->flush();
        $tags = $em->getRepository('AppBundle:Tag')->findAll();
        return $this->render('tag/index.html.twig', array(
            'tags' => $tags,
            'description'=>''


        ));
        }

    /**
     * Displays a form to edit an existing tag entity.
     *
     * @Route("/{id}/confirm", name="tag_confirm")
     * @Method({"GET", "POST"})
     */
    public function confirmAction(Request $request, Tag $tag)
    {
        $em = $this->getDoctrine()->getManager();
        $tag->setConfirmed(true);
        $this->getDoctrine()->getManager()->flush();
        $tags = $em->getRepository('AppBundle:Tag')->findAll();
        return $this->render('tag/index.html.twig', array(
            'tags' => $tags,
            'description'=>'Tag Confirmed'

        ));
    }

    /**
     * Displays a form to edit an existing tag entity.
     *
     * @Route("/{id}/unconfirm", name="tag_unconfirm")
     * @Method({"GET", "POST"})
     */
    public function unConfirmAction(Request $request, Tag $tag)
    {
        $em = $this->getDoctrine()->getManager();
        $tag->setConfirmed(false);
        $this->getDoctrine()->getManager()->flush();
        $tags = $em->getRepository('AppBundle:Tag')->findAll();
        return $this->render('tag/index.html.twig', array(
            'tags' => $tags,
            'description'=>'Tag Set to Not Confirmed'

        ));
    }


    /**
     * Displays a form to edit an existing tag entity.
     *
     * @Route("/{id}/downvote", name="tag_downvote")
     * @Method({"GET", "POST"})
     */
    public function downVoteAction(Request $request, Tag $tag)
    {
        $em = $this->getDoctrine()->getManager();
        $voteMultiplier=$this->checkUserAuthentication();
        //var_dump($voteMultiplier);
        $tag->setNumVotes($tag->getNumVotes()-1*$voteMultiplier);
        $this->getDoctrine()->getManager()->flush();
        $tags = $em->getRepository('AppBundle:Tag')->findAll();
        return $this->render('tag/index.html.twig', array(
            'tags' => $tags,
            'description'=>''

        ));
    }

    /**
     * Deletes a tag entity.
     *
     * @Route("/{id}", name="tag_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Tag $tag)
    {
        $form = $this->createDeleteForm($tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tag);
            $em->flush();
        }

        return $this->redirectToRoute('tag_index');
    }

    /**
     * Creates a form to delete a tag entity.
     *
     * @param Tag $tag The tag entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tag $tag)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tag_delete', array('id' => $tag->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    private function checkUserAuthentication()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'))
            {
            return $votemultiplier = 1;
            }
        else return $votemultiplier = 5;
    }
}
