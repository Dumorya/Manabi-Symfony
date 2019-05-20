<?php

namespace App\Controller;

use App\Entity\Word;
use App\Entity\WordsList;
use App\Form\WordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class WordController extends AbstractController
{
    /**
     * @Route("/list/{id}/word/new", name="add_words",  methods={"GET","POST"})
     */
    public function index(Request $request, WordsList $wordsList) : Response
    {
        $word = new Word();
        $word->setWordsList($wordsList);
        $form = $this->createForm(WordType::class, $word);
        $form->handleRequest($request);

        $repository = $this->getDoctrine()->getRepository(Word::class);
        $words = $repository->findByWordsListId($wordsList->getId());

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($word);
            $entityManager->flush();

            return $this->redirectToRoute('show_list', [
                'id' => $wordsList->getId(),
            ]);
        }

        return $this->render('word/new_word.html.twig', [
            'words' => $words,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/word/show/{id}", name="show_word", methods={"GET"})
     */
    public function show(Word $word): Response
    {
        return $this->render('word/show_word.html.twig', [
            'word' => $word,
        ]);
    }

    /**
     * @Route("/word/edit_word/{id}", name="edit_word", methods={"GET","POST"})
     */
    public function edit(Request $request, Word $word): Response
    {
        $form = $this->createForm(WordType::class, $word);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('show_word', [
                'id' => $word->getId(),
            ]);
        }

        return $this->render('word/edit_word.html.twig', [
            'word' => $word,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/word/delete/{id}", name="delete_word", methods={"DELETE"})
     */
    public function delete(Request $request, Word $word): Response
    {
        if ($this->isCsrfTokenValid('delete'.$word->getId(), $request->request->get('_token')))
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($word);
            $entityManager->flush();
        }

        // get current wordslist id
        $wordsListId = $word->getWordsList();
        $repository  = $this->getDoctrine()->getRepository(WordsList::class);
        // get the current list with the id
        $list        = $repository->find($wordsListId);

        return $this->redirectToRoute('show_list', [
            'id' => $list->getId(),
        ]);
    }
}
