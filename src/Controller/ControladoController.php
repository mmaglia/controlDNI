<?php

namespace App\Controller;

use App\Entity\Controlado;
use App\Form\ControladoType;
use App\Repository\ControladoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/controlado")
 */
class ControladoController extends AbstractController
{
    /**
     * @Route("/", name="controlado_index", methods={"GET"})
     */
    public function index(ControladoRepository $controladoRepository): Response
    {
        return $this->render('controlado/index.html.twig', [
            'controlados' => $controladoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="controlado_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $controlado = new Controlado();
        $form = $this->createForm(ControladoType::class, $controlado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($controlado);
            $entityManager->flush();

            return $this->redirectToRoute('controlado_index');
        }

        return $this->render('controlado/new.html.twig', [
            'controlado' => $controlado,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="controlado_show", methods={"GET"})
     */
    public function show(Controlado $controlado): Response
    {
        return $this->render('controlado/show.html.twig', [
            'controlado' => $controlado,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="controlado_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Controlado $controlado): Response
    {
        $form = $this->createForm(ControladoType::class, $controlado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('controlado_index');
        }

        return $this->render('controlado/edit.html.twig', [
            'controlado' => $controlado,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="controlado_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Controlado $controlado): Response
    {
        if ($this->isCsrfTokenValid('delete'.$controlado->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($controlado);
            $entityManager->flush();
        }

        return $this->redirectToRoute('controlado_index');
    }
}
