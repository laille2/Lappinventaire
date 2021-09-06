<?php

namespace App\Controller;

use App\Entity\CollectionEntity;
use App\Form\CollectionEntityType;
use App\Repository\CollectionEntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/collection/entity")
 */
class CollectionEntityController extends AbstractController
{
    /**
     * @Route("/", name="collection_entity_index", methods={"GET"})
     */
    public function index(CollectionEntityRepository $collectionEntityRepository): Response
    {
        return $this->render('collection_entity/index.html.twig', [
            'collection_entities' => $collectionEntityRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="collection_entity_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $collectionEntity = new CollectionEntity();
        $form = $this->createForm(CollectionEntityType::class, $collectionEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($collectionEntity);
            $entityManager->flush();

            return $this->redirectToRoute('collection_entity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('collection_entity/new.html.twig', [
            'collection_entity' => $collectionEntity,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="collection_entity_show", methods={"GET"})
     */
    public function show(CollectionEntity $collectionEntity): Response
    {
        return $this->render('collection_entity/show.html.twig', [
            'collection_entity' => $collectionEntity,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="collection_entity_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CollectionEntity $collectionEntity): Response
    {
        $form = $this->createForm(CollectionEntityType::class, $collectionEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('collection_entity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('collection_entity/edit.html.twig', [
            'collection_entity' => $collectionEntity,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="collection_entity_delete", methods={"POST"})
     */
    public function delete(Request $request, CollectionEntity $collectionEntity): Response
    {
        if ($this->isCsrfTokenValid('delete'.$collectionEntity->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($collectionEntity);
            $entityManager->flush();
        }

        return $this->redirectToRoute('collection_entity_index', [], Response::HTTP_SEE_OTHER);
    }
}
