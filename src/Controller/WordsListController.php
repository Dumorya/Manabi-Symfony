<?php

namespace App\Controller;

use App\Entity\WordsList;
use App\Entity\User;
use App\Form\WordsListType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Security\Core\User\UserInterface;

class WordsListController extends AbstractController
{
    /**
     * @Route("/words/list", name="words_list")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(WordsList::class);

        // get the number of lists
        $listNumber = $repository->countLists();

        // get all the lists
        $lists = $repository->findAll();

        error_log(json_encode($lists));

        return $this->render('words_list/wordslist.html.twig', [
            'controller_name' => 'WordsListController',
            'listNumber'      => $listNumber,
            'lists'           => $lists,
        ]);
    }

    /**
     * @Route("/new_list", name="new_list", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $wordsList = new WordsList();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $wordsList->setUserId($user);
        $form = $this->createForm(WordsListType::class, $wordsList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($wordsList);
            $entityManager->flush();

            return $this->redirectToRoute('words_list');
        }

        return $this->render('words_list/new_list.html.twig', [
            'wordsList' => $wordsList,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show_list", methods={"GET"})
     */
    public function show(WordsList $list): Response
    {
        return $this->render('words_list/show_list.html.twig', [
            'list' => $list,
        ]);
    }

    /**
     * @Route("/{id}/edit_list", name="edit_list", methods={"GET","POST"})
     */
    public function edit(Request $request, WordsList $list): Response
    {
        $form = $this->createForm(WordsListType::class, $list);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('words_list', [
                'id' => $list->getId(),
            ]);
        }

        return $this->render('product/edit_list.html.twig', [
            'list' => $list,
            'form' => $form->createView(),
        ]);
    }
}
