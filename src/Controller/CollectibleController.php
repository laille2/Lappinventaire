<?php

namespace App\Controller;

use App\Entity\Collectible;
use App\Entity\Property;
use App\Form\CollectibleType;
use App\Repository\CollectibleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/collectible")
 */
class CollectibleController extends AbstractController
{
    /**
     * @Route("/", name="collectible_index", methods={"GET"})
     */
    public function index(CollectibleRepository $collectibleRepository): Response
    {
        return $this->render('collectible/index.html.twig', [
            'collectibles' => $collectibleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="collectible_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $collectible = new Collectible();

        $quantity = new Property();
        $quantity->setName("Quantité");
        $quantity->setType("Integer");
        $quantity->setValue(1);

        $collectible->setPropertiesArray([$quantity]);

        $form = $this->createForm(CollectibleType::class, $collectible);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($collectible);
            $entityManager->flush();

            return $this->redirectToRoute('collectible_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('collectible/new.html.twig', [
            'collectible' => $collectible,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="collectible_show", methods={"GET"})
     */
    public function show(Collectible $collectible): Response
    {
        return $this->render('collectible/show.html.twig', [
            'collectible' => $collectible,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="collectible_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Collectible $collectible): Response
    {
        $form = $this->createForm(CollectibleType::class, $collectible);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('collectible_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('collectible/edit.html.twig', [
            'collectible' => $collectible,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="collectible_delete", methods={"POST"})
     */
    public function delete(Request $request, Collectible $collectible): Response
    {
        if ($this->isCsrfTokenValid('delete'.$collectible->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($collectible);
            $entityManager->flush();
        }

        return $this->redirectToRoute('collectible_index', [], Response::HTTP_SEE_OTHER);
    }
}
