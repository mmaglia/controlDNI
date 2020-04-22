<?php

namespace App\Controller;

use App\Entity\BlackList;
use App\Form\BlackListType;
use App\Repository\BlackListRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/black/list")
 */
class BlackListController extends AbstractController
{
    /**
     * @Route("/", name="black_list_index", methods={"GET"})
     */
    public function index(BlackListRepository $blackListRepository): Response
    {
        return $this->render('black_list/index.html.twig', [
            'black_lists' => $blackListRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="black_list_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $blackList = new BlackList();
        $form = $this->createForm(BlackListType::class, $blackList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($blackList);
            $entityManager->flush();

            return $this->redirectToRoute('black_list_index');
        }

        return $this->render('black_list/new.html.twig', [
            'black_list' => $blackList,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="black_list_show", methods={"GET"})
     */
    public function show(BlackList $blackList): Response
    {
        return $this->render('black_list/show.html.twig', [
            'black_list' => $blackList,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="black_list_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, BlackList $blackList): Response
    {
        $form = $this->createForm(BlackListType::class, $blackList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('black_list_index');
        }

        return $this->render('black_list/edit.html.twig', [
            'black_list' => $blackList,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="black_list_delete", methods={"DELETE"})
     */
    public function delete(Request $request, BlackList $blackList): Response
    {
        if ($this->isCsrfTokenValid('delete'.$blackList->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($blackList);
            $entityManager->flush();
        }

        return $this->redirectToRoute('black_list_index');
    }
}
