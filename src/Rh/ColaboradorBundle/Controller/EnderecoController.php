<?php

namespace Rh\ColaboradorBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Rh\ColaboradorBundle\Entity\Endereco;
use Rh\ColaboradorBundle\Entity\Funcionario;
use Rh\ColaboradorBundle\Form\EnderecoType;

/**
 * Endereco controller.
 *
 * @Route("/endereco")
 */
class EnderecoController extends Controller
{
    /**
     * Finds and displays a Adreess of Funcionario.
     *
     * @Route("/{id}/endereco", name="endereco_funcionario")
     * @Method({"GET", "POST"})
     */
    public function enderecoAction($id)
    {
        $funcionario = $this->getDoctrine()->getRepository('RhColaboradorBundle:Funcionario')->find($id);
        if (!$funcionario) {
            return $this->redirectToRoute('funcionario_index');
        }else{
            $endereco = $this->getDoctrine()->getRepository('RhColaboradorBundle:Endereco')->findOneByIdFuncionario($funcionario);

            if($endereco) {
                return $this->redirectToRoute('endereco_edit',  array('id' => $funcionario->getId()));
            }else{
                return $this->redirectToRoute('endereco_new', array('id' => $funcionario->getId()));
            }
        }
    }

    /**
     * Creates a new Endereco entity.
     *
     * @Route("/{id}/add", name="endereco_new")
     * @Method({"GET", "POST"})
     */
    public function newAction($id, Request $request)
    {
        $funcionario = $this->getDoctrine()->getRepository('RhColaboradorBundle:Funcionario')->find($id);
        if (!$funcionario) {
            return $this->redirectToRoute('funcionario_index');
        }else {
            $endereco = new Endereco();
            $form = $this->createForm('Rh\ColaboradorBundle\Form\EnderecoType', $endereco);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $endereco->setIdFuncionario($funcionario);
                $em = $this->getDoctrine()->getManager();
                $em->persist($endereco);
                $em->flush();

                return $this->redirectToRoute('endereco_funcionario_show', array('id' => $funcionario->getId()));
            }

            return $this->render('endereco/form.html.twig', array(
                'funcionario' => $funcionario,
                'endereco' => $endereco,
                'form' => $form->createView(),
            ));
        }
    }

    /**
     * Finds and displays a Endereco entity.
     *
     * @Route("/{id}/view", name="endereco_funcionario_show")
     * @Method("GET")
     */
    public function showEnderecoAction($id)
    {
        $funcionario = $this->getDoctrine()->getRepository('RhColaboradorBundle:Funcionario')->find($id);
        if (!$funcionario) {
            return $this->redirectToRoute('funcionario_index');
        }else {
            $endereco = $this->getDoctrine()->getRepository('RhColaboradorBundle:Endereco')->findOneByIdFuncionario($funcionario);

            if($endereco) {
                return $this->render('endereco/show.html.twig', array(
                    'endereco' => $endereco,
                    'funcionario' => $funcionario,
                ));
            }

            return $this->redirectToRoute('funcionario_index');

        }
    }

    /**
     * Finds and displays a Endereco entity.
     *
     * @Route("/{id}", name="endereco_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        //$deleteForm = $this->createDeleteForm($endereco);
        $endereco = $this->getDoctrine()->getRepository('RhColaboradorBundle:Endereco')->find($id);

        if($endereco) {
            return $this->render('endereco/showCOPY.html.twig', array(
                'endereco' => $endereco,
                //'delete_form' => $deleteForm->createView(),
            ));
        }else{
            return $this->redirectToRoute('funcionario_index');
        }
    }

    /**
     * Displays a form to edit an existing Endereco entity.
     *
     * @Route("/{id}/edit", name="endereco_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction($id, Request $request)
    {
        $funcionario = $this->getDoctrine()->getRepository('RhColaboradorBundle:Funcionario')->find($id);

        if (!$funcionario) {
            return $this->redirectToRoute('funcionario_index');
        }else {
            $endereco = $this->getDoctrine()->getRepository('RhColaboradorBundle:Endereco')->findOneByIdFuncionario($id);
            if (!$endereco) {
                return $this->redirectToRoute('endereco_new', array('id' => $funcionario->getId()));
            }else {
                $editForm = $this->createForm('Rh\ColaboradorBundle\Form\EnderecoType', $endereco);
                $editForm->handleRequest($request);

                if ($editForm->isSubmitted() && $editForm->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($endereco);
                    $em->flush();

                    return $this->redirectToRoute('endereco_funcionario_show', array('id' => $funcionario->getId()));
                }

                return $this->render('endereco/edit.html.twig', array(
                    'funcionario' => $funcionario,
                    'endereco' => $endereco,
                    'edit_form' => $editForm->createView()
                ));
            }
        }
    }

    /**
     * Deletes a Endereco entity.
     *
     * @Route("/{id}/delete", name="endereco_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Endereco $endereco)
    {
        $form = $this->createDeleteForm($endereco);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($endereco);
            $em->flush();
        }

        return $this->redirectToRoute('endereco_index');
    }

    /**
     * Creates a form to delete a Endereco entity.
     *
     * @param Endereco $endereco The Endereco entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Endereco $endereco)
    {

        return $this->createFormBuilder()
            ->setAction($this->generateUrl('endereco_delete', array('id' => $endereco->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
