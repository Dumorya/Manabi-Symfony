<?php

namespace App\Controller;

use App\Entity\WordsList;
use App\Form\WordsListType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class WordsListController extends AbstractController
{
    /**
     * @Route("/words/list", name="words_list")
     */
    public function index()
    {
        $lists = $this->getDoctrine()
            ->getRepository(WordsList::class)
            ->countLists();

        return $this->render('words_list/wordslist.html.twig', [
            'controller_name' => 'WordsListController',
            'lists' => $lists,
        ]);
    }

    /**
     * @Route("/new_list", name="new_list", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $wordList = new WordsList();
        $form = $this->createForm(WordsListType::class, $wordList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($wordList);
            $entityManager->flush();

            return $this->redirectToRoute('words_list');
        }

        return $this->render('words_list/new_list.html.twig', [
            'wordList' => $wordList,
            'form' => $form->createView(),
        ]);
    }

//    public function hasLists()
//    {
//        $lists = $this->getDoctrine()
//            ->getRepository(WordsList::class)
//            ->countLists();
//
//        return $lists;
//    }
}
