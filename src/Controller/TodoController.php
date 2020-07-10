<?php

namespace App\Controller;

use App\Entity\Todo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    /**
     * @Route("/todo", name="todo")
     */
    public function index()
    {
        return $this->render('todo/index.html.twig', [
            'controller_name' => 'TodoController',
        ]);
    }

    /**
     * @Route("/todo/add", name="todo_add")
     */
    public function addTodo()
    {
        $todo = new Todo();
        $todo->setActivity('Belajar Symfony');
        $this->getDoctrine()->getManager()->persist($todo);
        $this->getDoctrine()->getManager()->flush();

        return new Response('Todo added.');
    }

    /**
     * @Route("/todo/all", name="todo_all")
     */
    public function getTodo()
    {
        $result = [];
        $todos = $this->getDoctrine()->getManager()->getRepository(Todo::class)->findAll();
        foreach ($todos as $todo) {
            $result[] = [
                'id' => $todo->getId(),
                'activity' => $todo->getActivity(),
                'is_done' => $todo->isDone(),
            ];
        }

        return new JsonResponse($result);
    }
}
