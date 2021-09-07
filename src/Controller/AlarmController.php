<?php

namespace App\Controller;

use App\Entity\Alarm;
use App\Form\AlarmType;
use App\Repository\AlarmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/alarm")
 */
class AlarmController extends AbstractController
{
    /**
     * @Route("/", name="alarm_index", methods={"GET"})
     */
    public function index(AlarmRepository $alarmRepository): Response
    {
        return $this->render('alarm/index.html.twig', [
            'alarms' => $alarmRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="alarm_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $alarm = new Alarm();
        $form = $this->createForm(AlarmType::class, $alarm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($alarm);
            $entityManager->flush();

            return $this->redirectToRoute('alarm_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('alarm/new.html.twig', [
            'alarm' => $alarm,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="alarm_show", methods={"GET"})
     */
    public function show(Alarm $alarm): Response
    {
        return $this->render('alarm/show.html.twig', [
            'alarm' => $alarm,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="alarm_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Alarm $alarm): Response
    {
        $form = $this->createForm(AlarmType::class, $alarm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('alarm_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('alarm/edit.html.twig', [
            'alarm' => $alarm,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="alarm_delete", methods={"POST"})
     */
    public function delete(Request $request, Alarm $alarm): Response
    {
        if ($this->isCsrfTokenValid('delete'.$alarm->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($alarm);
            $entityManager->flush();
        }

        return $this->redirectToRoute('alarm_index', [], Response::HTTP_SEE_OTHER);
    }
}
