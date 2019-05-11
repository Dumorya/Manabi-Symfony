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
     * @Route("/word/{id}", name="add_words",  methods={"GET","POST"})
     */
    public function index(Request $request, WordsList $wordsList) : Response
    {
        $word = new Word();
        $word->setWordsListId($wordsList);
        $form = $this->createForm(WordType::class, $word);
        $form->handleRequest($request);

        $repository = $this->getDoctrine()->getRepository(Word::class);
        $words = $repository->findByWordsListId($wordsList->getId());

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($word);
            $entityManager->flush();

            return $this->render('words_list/show_list.html.twig', [
                'id'   => $wordsList->getId(),
                'list' => $wordsList,
                'words' => $words,
            ]);
        }

        return $this->$words('word/new_word.html.twig', [
            'words' => $words,
            'form' => $form->createView(),
        ]);
    }
}
