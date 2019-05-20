<?php

namespace App\Controller;

use App\Entity\Word;
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
     * @Route("/list", name="words_list")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(WordsList::class);

        $user       = $this->container->get('security.token_storage')->getToken()->getUser();
        $userId     = $user->getId();

        // get the number of lists
        $listNumber = $repository->countUserLists($userId);

        // get all the lists of the current user
        $lists = $repository->getUserLists($userId);

        return $this->render('words_list/wordslist.html.twig', [
            'controller_name' => 'WordsListController',
            'listNumber'      => $listNumber,
            'lists'           => $lists,
        ]);
    }

    /**
     * @Route("/list/new", name="new_list", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $wordsList = new WordsList();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $wordsList->setUser($user);
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
     * @Route("/list/{id}", name="show_list", methods={"GET"})
     */
    public function show(WordsList $list): Response
    {
        $repository = $this->getDoctrine()->getRepository(Word::class);
        $words = $repository->findByWordsListId($list->getId());

        return $this->render('words_list/show_list.html.twig', [
            'list' => $list,
            'words' => $words,
        ]);
    }

    /**
     * @Route("/list/edit/{id}", name="edit_list", methods={"GET","POST"})
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

        return $this->render('words_list/edit_list.html.twig', [
            'list' => $list,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/list/delete/{id}", name="delete_list", methods={"DELETE"})
     */
    public function delete(Request $request, WordsList $list): Response
    {
        if ($this->isCsrfTokenValid('delete'.$list->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($list);
            $entityManager->flush();
        }

        return $this->redirectToRoute('words_list');
    }
}
