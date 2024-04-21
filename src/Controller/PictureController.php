<?php

namespace App\Controller;

use App\Entity\{Picture, PreDBPicture};
use App\Form\PictureType;
use App\Service\FileUploader;

use App\Repository\PictureRepository;
use App\Repository\PlayRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/picture")
 */
class PictureController extends AbstractController
{
    /**
     * @Route("/", name="app_picture_index", methods={"GET"})
     */
    public function index(PictureRepository $pictureRepository): Response
    {
        // TODO
        $notifications = 2;
        // dd($pictureRepository->findAll());
        return $this->render('picture/index.html.twig', [
            'pictures' => $pictureRepository->findAll(),
            'notifications' => $notifications,
        ]);
    }

    /**
     * @Route("/new", name="app_picture_new", methods={"GET", "POST"})
     */
    public function new(
        Request $request,
        PlayRepository $playRepository,
        PictureRepository $pictureRepository,
        FileUploader $fileUploader
        ): Response
    {
        $picture = new Picture();

        $plays = $playRepository->findAll();

        $form = $this->createForm(PictureType::class, $picture, [
            "data" => ['plays' => $plays],
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            
            $fileName = $fileUploader->upload($data['attachment']);
            $picture->setPlayId($data['play_id']);
            $picture->setCredits($data['credits']);
            $picture->setUrl('../images/' . $fileName);
            
            $pictureRepository->add($picture, true);

            return $this->redirectToRoute('app_picture_index', [], Response::HTTP_SEE_OTHER);
        }

        // if ($form->isSubmitted() && $form->isValid()) {

        //     dd($form->getData());
        //     // return $this->redirectToRoute('app_picture_index', [], Response::HTTP_SEE_OTHER);
        // }

        // TODO
        $notifications = 2;

        return $this->renderForm('picture/new.html.twig', [
            'picture' => $picture,
            'form' => $form,
            'notifications' => $notifications,
        ]);
    }


























































    /**
     * @Route("/{id}", name="app_picture_show", methods={"GET"})
     */
    public function show(Picture $picture): Response
    {
        return $this->render('picture/show.html.twig', [
            'picture' => $picture,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_picture_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Picture $picture, PictureRepository $pictureRepository): Response
    {
        $form = $this->createForm(PictureType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pictureRepository->add($picture, true);

            return $this->redirectToRoute('app_picture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('picture/edit.html.twig', [
            'picture' => $picture,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_picture_delete", methods={"POST"})
     */
    public function delete(Request $request, Picture $picture, PictureRepository $pictureRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$picture->getId(), $request->request->get('_token'))) {
            $pictureRepository->remove($picture, true);
        }

        return $this->redirectToRoute('app_picture_index', [], Response::HTTP_SEE_OTHER);
    }
}
