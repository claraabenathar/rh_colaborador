<?php

namespace Rh\ColaboradorBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Rh\ColaboradorBundle\Entity\Dependente;
use Rh\ColaboradorBundle\Form\DependenteType;
use Rh\ColaboradorBundle\Entity\Funcionario;


/**
 * Dependente controller.
 *
 * @Route("/dependente")
 */
class DependenteController extends Controller
{
    /**
     * Lists all Dependente entities.
     *
     * @Route("/{id}", name="dependente_index")
     * @Method("GET")
     */
    public function indexAction($id)
    {
        $funcionario = $this->getDoctrine()->getRepository('RhColaboradorBundle:Funcionario')->find($id);
        if (!$funcionario) {
            return $this->redirectToRoute('funcionario_index');
        }

        $em = $this->getDoctrine()->getManager();
        $dependentes = $em->getRepository('RhColaboradorBundle:Dependente')->findByIdFuncionario($funcionario);

        return $this->render('dependente/index.html.twig', array(
            'dependentes' => $dependentes,
            'funcionario'=> $funcionario
        ));
    }

    /**
     * Creates a new Dependente entity.
     *
     * @Route("/{id}/dependente", name="dependente_funcionario")
     * @Method({"GET", "POST"})
     */
    public function dependenteAction($id)
    {
        $funcionario = $this->getDoctrine()->getRepository('RhColaboradorBundle:Funcionario')->find($id);
        if (!$funcionario) {
            return $this->redirectToRoute('funcionario_index');
        }else{
            $dependente = $this->getDoctrine()->getRepository('RhColaboradorBundle:Dependente')->findOneByIdFuncionario($funcionario);

            if($dependente) {
                return $this->redirectToRoute('dependente_index',  array('id' => $funcionario->getId()));
            }else{
                return $this->redirectToRoute('dependente_new', array('id' => $funcionario->getId()));
            }
        }
    }

    /**
     * Creates a new Dependente entity.
     *
     * @Route("/{id}/add", name="dependente_new")
     * @Method({"GET", "POST"})
     */
    public function newAction($id, Request $request)
    {
        $funcionario = $this->getDoctrine()->getRepository('RhColaboradorBundle:Funcionario')->find($id);
        if (!$funcionario) {
            return $this->redirectToRoute('funcionario_index');
        }else {
            $dependente = new Dependente();
            $form = $this->createForm('Rh\ColaboradorBundle\Form\DependenteType', $dependente);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $dependente->setIdFuncionario($funcionario);
                $em = $this->getDoctrine()->getManager();
                $em->persist($dependente);
                $em->flush();
                return $this->redirectToRoute('dependente_index', array('id' =>  $funcionario->getId()));
            }

            return $this->render('dependente/new.html.twig', array(
                'dependente' => $dependente,
                'form' => $form->createView(),
                '$funcionario' => $funcionario
            ));

        }

    }

    /**
     * Displays a form to edit an existing Dependente entity.
     *
     * @Route("/{funcionario}/{id}/edit", name="dependente_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction($funcionario, $id, Request $request)
    {
        $funcionario = $this->getDoctrine()->getRepository('RhColaboradorBundle:Funcionario')->find($funcionario);
        if (!$funcionario) {
            return $this->redirectToRoute('funcionario_index');
        }

        $dependente = $this->getDoctrine()->getRepository('RhColaboradorBundle:Dependente')->find($id);
        if (!$dependente) {
            return $this->redirectToRoute('dependente_show', array('id' =>  $funcionario->getId()));
        }

        $deleteForm = $this->createDeleteForm($dependente);
        $editForm = $this->createForm('Rh\ColaboradorBundle\Form\DependenteType', $dependente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $dependente->setUpdatedAt(new\DateTime('now'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($dependente);
            $em->flush();
            return $this->redirectToRoute('dependente_index', array('id' =>  $funcionario->getId()));
            //return $this->redirectToRoute('dependente_edit', array('funcionario' => $funcionario->getId(), 'id' => $dependente->getId()));
        }

        return $this->render('dependente/edit.html.twig', array(
            'funcionario' => $funcionario,
            'dependente' => $dependente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Dependente entity.
     *
     * @Route("/{id}", name="dependente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Dependente $dependente)
    {
        $form = $this->createDeleteForm($dependente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($dependente);
            $em->flush();
        }

        return $this->redirectToRoute('dependente_index');
    }

    /**
     * Creates a form to delete a Dependente entity.
     *
     * @param Dependente $dependente The Dependente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Dependente $dependente)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('dependente_delete', array('id' => $dependente->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
