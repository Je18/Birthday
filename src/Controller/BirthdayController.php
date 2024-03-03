<?php

namespace App\Controller;

use App\Entity\Birthday;
use App\Form\BirthdayType;
use App\Repository\BirthdayRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/birthday")
 */
class BirthdayController extends AbstractController
{
    /**
     * @Route("/", name="app_birthday_index", methods={"GET"})
     */
    public function index(BirthdayRepository $birthdayRepository): Response
    {
        return $this->render('birthday/index.html.twig', [
            'birthdays' => $birthdayRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_birthday_new", methods={"GET", "POST"})
     */
    public function new(Request $request, BirthdayRepository $birthdayRepository): Response
    {
        $birthday = new Birthday();
        $form = $this->createForm(BirthdayType::class, $birthday);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $birthdayRepository->add($birthday, true);

            return $this->redirectToRoute('app_birthday_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('birthday/new.html.twig', [
            'birthday' => $birthday,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_birthday_show", methods={"GET"})
     */
    public function show(Birthday $birthday): Response
    {
        return $this->render('birthday/show.html.twig', [
            'birthday' => $birthday,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_birthday_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Birthday $birthday, BirthdayRepository $birthdayRepository): Response
    {
        $form = $this->createForm(BirthdayType::class, $birthday);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $birthdayRepository->add($birthday, true);

            return $this->redirectToRoute('app_birthday_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('birthday/edit.html.twig', [
            'birthday' => $birthday,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_birthday_delete", methods={"POST"})
     */
    public function delete(Request $request, Birthday $birthday, BirthdayRepository $birthdayRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$birthday->getId(), $request->request->get('_token'))) {
            $birthdayRepository->remove($birthday, true);
        }

        return $this->redirectToRoute('app_birthday_index', [], Response::HTTP_SEE_OTHER);
    }
}
