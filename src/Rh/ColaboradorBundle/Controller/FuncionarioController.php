<?php

namespace Rh\ColaboradorBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Rh\ColaboradorBundle\Entity\Funcionario;
use Rh\ColaboradorBundle\Form\FuncionarioType;

/**
 * Funcionario controller.
 *
 * @Route("/")
 */
class FuncionarioController extends Controller
{
    /**
     * Lists all Funcionario entities.
     *
     * @Route("/", name="funcionario_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $funcionarios = $em->getRepository('RhColaboradorBundle:Funcionario')->findAll();

        return $this->render('funcionario/index.html.twig', array(
            'funcionarios' => $funcionarios,
        ));
    }

    /**
     * Creates a new Funcionario entity.
     *
     * @Route("/new", name="funcionario_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $funcionario = new Funcionario();
        $form = $this->createForm('Rh\ColaboradorBundle\Form\FuncionarioType', $funcionario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($funcionario);
            $em->flush();

            return $this->redirectToRoute('funcionario_show', array('id' => $funcionario->getId()));
        }

        return $this->render('funcionario/new.html.twig', array(
            'funcionario' => $funcionario,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Funcionario entity.
     *
     * @Route("/view/{id}", name="funcionario_show")
     * @Method("GET")
     */
    public function showAction(Funcionario $funcionario)
    {
        $deleteForm = $this->createDeleteForm($funcionario);

        return $this->render('funcionario/show.html.twig', array(
            'funcionario' => $funcionario,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Funcionario entity.
     *
     * @Route("/{id}/edit", name="funcionario_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Funcionario $funcionario)
    {
        $editForm = $this->createForm('Rh\ColaboradorBundle\Form\FuncionarioType', $funcionario);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $funcionario->setUpdatedAt(new\DateTime('now'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($funcionario);
            $em->flush();

            //return $this->redirectToRoute('funcionario_edit', array('id' => $funcionario->getId()));
            return $this->redirectToRoute('funcionario_show', array('id' => $funcionario->getId()));
        }

        return $this->render('funcionario/edit.html.twig', array(
            'funcionario' => $funcionario,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Funcionario entity.
     *
     * @Route("/{id}/delete", name="funcionario_remove")
     * @Method("DELETE")
     */
    public function removeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $funcionario = $em->getRepository('RhColaboradorBundle:Funcionario')->find($id);

        if (!$funcionario) {
            return $this->redirectToRoute('funcionario_index');
        }
            $em->remove($funcionario);
            $em->flush();

        return $this->redirectToRoute('funcionario_index');
    }

    /**
     * Deletes a Funcionario entity.
     *
     * @Route("/remove/{id}", name="funcionario_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Funcionario $funcionario)
    {
        $form = $this->createDeleteForm($funcionario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($funcionario);
            $em->flush();
        }

        return $this->redirectToRoute('funcionario_index');
    }

    /**
     * Creates a form to delete a Funcionario entity.
     *
     * @param Funcionario $funcionario The Funcionario entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Funcionario $funcionario)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('funcionario_delete', array('id' => $funcionario->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
