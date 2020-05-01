<?php

namespace App\Controller;

use App\Entity\ListaControl;
use App\Form\ListaControlType;
use App\Repository\ListaControlRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;

/**
 * @Route("/lista/control")
 */
class ListaControlController extends AbstractController
{
    /**
     * @Route("/", name="lista_control_index", methods={"GET"})
     */
    public function index(ListaControlRepository $listaControlRepository): Response
    {
        return $this->render('lista_control/index.html.twig', [
            'lista_controls' => $listaControlRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="lista_control_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $listaControl = new ListaControl();
        $form = $this->createForm(ListaControlType::class, $listaControl);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($listaControl);
            $entityManager->flush();

            return $this->redirectToRoute('lista_control_index');
        }

        return $this->render('lista_control/new.html.twig', [
            'lista_control' => $listaControl,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lista_control_show", methods={"GET"})
     */
    public function show(ListaControl $listaControl): Response
    {
        return $this->render('lista_control/show.html.twig', [
            'lista_control' => $listaControl,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="lista_control_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ListaControl $listaControl): Response
    {
        $form = $this->createForm(ListaControlType::class, $listaControl);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lista_control_index');
        }

        return $this->render('lista_control/edit.html.twig', [
            'lista_control' => $listaControl,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lista_control_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ListaControl $listaControl): Response
    {
        if ($this->isCsrfTokenValid('delete'.$listaControl->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($listaControl);
            $entityManager->flush();
        }

        return $this->redirectToRoute('lista_control_index');
    }


    /**
     * @Route("/pdf", name="lista_control_show", methods={"GET"})
     */
    public function showPDF(ListaControlRepository $listaControlRepository, \Knp\Snappy\Pdf $snappy)
    {

        // Aquí puedo definir plantillas genéricas para el header y footer de todos los listados
        $header = $this->renderView('pdf/header.html.twig');
        $footer = $this->renderView('pdf/footer.html.twig');

        $html =  $this->renderView('lista_control/listado.html.twig', [
            'lista_controls' => $listaControlRepository->findAll(),
        ]);

        // Se modifica algunas opciones para este informe. Si siempre se usarán, trasladar al archivo de configuración
//        $snappy->setOption('orientation', 'Landscape');
        $snappy->setOption('page-size', 'A4');
        $snappy->setOption('viewport-size', '1024x768');
        
        return new PdfResponse($snappy->getOutputFromHtml($html), 'file.pdf');
    }

}
