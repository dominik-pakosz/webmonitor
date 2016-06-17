<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\WebmonitorLogTypes;
use AppBundle\Form\WebmonitorLogTypesType;

/**
 * WebmonitorLogTypes controller.
 *
 * @Route("/type")
 */
class WebmonitorLogTypesController extends Controller
{
    /**
     * Lists all WebmonitorLogTypes entities.
     *
     * @Route("/", name="type_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $webmonitorLogTypes = $em->getRepository('AppBundle:WebmonitorLogTypes')->findAll();

        return $this->render('webmonitorlogtypes/index.html.twig', array(
            'webmonitorLogTypes' => $webmonitorLogTypes,
        ));
    }

    /**
     * Creates a new WebmonitorLogTypes entity.
     *
     * @Route("/new", name="type_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $webmonitorLogType = new WebmonitorLogTypes();
        $form = $this->createForm('AppBundle\Form\WebmonitorLogTypesType', $webmonitorLogType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($webmonitorLogType);
            $em->flush();

            return $this->redirectToRoute('type_show', array('id' => $webmonitorLogType->getId()));
        }

        return $this->render('webmonitorlogtypes/new.html.twig', array(
            'webmonitorLogType' => $webmonitorLogType,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a WebmonitorLogTypes entity.
     *
     * @Route("/{id}", name="type_show")
     * @Method("GET")
     */
    public function showAction(WebmonitorLogTypes $webmonitorLogType)
    {
        $deleteForm = $this->createDeleteForm($webmonitorLogType);

        return $this->render('webmonitorlogtypes/show.html.twig', array(
            'webmonitorLogType' => $webmonitorLogType,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing WebmonitorLogTypes entity.
     *
     * @Route("/{id}/edit", name="type_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, WebmonitorLogTypes $webmonitorLogType)
    {
        $deleteForm = $this->createDeleteForm($webmonitorLogType);
        $editForm = $this->createForm('AppBundle\Form\WebmonitorLogTypesType', $webmonitorLogType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($webmonitorLogType);
            $em->flush();

            return $this->redirectToRoute('type_edit', array('id' => $webmonitorLogType->getId()));
        }

        return $this->render('webmonitorlogtypes/edit.html.twig', array(
            'webmonitorLogType' => $webmonitorLogType,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a WebmonitorLogTypes entity.
     *
     * @Route("/{id}", name="type_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, WebmonitorLogTypes $webmonitorLogType)
    {
        $form = $this->createDeleteForm($webmonitorLogType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($webmonitorLogType);
            $em->flush();
        }

        return $this->redirectToRoute('type_index');
    }

    /**
     * Creates a form to delete a WebmonitorLogTypes entity.
     *
     * @param WebmonitorLogTypes $webmonitorLogType The WebmonitorLogTypes entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(WebmonitorLogTypes $webmonitorLogType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('type_delete', array('id' => $webmonitorLogType->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
