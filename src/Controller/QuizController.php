<?php

namespace App\Controller;

use App\Entity\WordsList;
use App\Form\QuizFlow;
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
        $list = $this->getDoctrine()->getRepository(WordsList::class)->findOneBy([ "id" => $chosenList ]);

        // TODO: faire un rand() en SQL en faisant un custom repository plutôt que de la faire après en PHP car là
        // TODO: on shuffle tous les mots de la liste et on en prend 20, c'est pas bon niveau perf

        // turn the object into an array
        $wordsArray = $list->getWords()->toArray();
        // shuffle all the words
        shuffle($wordsArray);
        // get only the 20 first words
        $wordsQuestion = array_slice($wordsArray, 0, 20);

        $questions = ['Que signifie ', 'Comment dit-on '];

        return $this->render('quiz/quiz.html.twig', [
            'list'      => $list,
            'words'     => $wordsQuestion,
            'questions' => $questions
        ]);
    }
}
