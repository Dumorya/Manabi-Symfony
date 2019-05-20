<?php

namespace App\Controller;

use App\Entity\WordsList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizController extends AbstractController
{
    /**
     * @Route("/quiz", name="quiz_wordslist")
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

        return $this->render('quiz/wordslist.html.twig', [
            'controller_name' => 'QuizController',
            'listNumber'      => $listNumber,
            'lists'           => $lists,
        ]);
    }

    /**
     * @Route("/quiz/list", name="start_quiz", methods={"GET","POST"})
     */
    public function getChosenList(Request $request) : Response
    {
        $chosenList = $request->request->get('_quizList');
        $list = $this->getDoctrine()->getRepository(WordsList::class)->findOneBy([ "name" => $chosenList ]);

        // TODO: faire un rand() en SQL en faiant un custom repository plutôt que de la faire après en PHP
        $wordsQuestion = array_rand($list->getWords()->toArray(), 3);

        return $this->render('quiz/quiz.html.twig', [
            'list' => $list,
            'words' => $wordsQuestion
        ]);
    }
}
