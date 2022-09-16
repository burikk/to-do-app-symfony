<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Task;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ToDoListController extends AbstractController
{
    private ManagerRegistry $registry;
    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @Route("/", name="to_do_list")
     */
    public function index(): Response
    {
        $tasks = $this->registry
            ->getRepository(Task::class)
            ->findBy([], ['id'=>'DESC']);

        return $this->render('to_do_list/index.html.twig', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * @Route("/create", name="create_task", methods={"POST"})
     */
    public function create(Request $request): Response
    {
        $title = $request->get('title');
        $entityManager = $this->registry->getManager();

        if (empty($title)) {
            return $this->redirectToRoute('to_do_list');
        }

        $task = new Task();
        $task->setTitle($title);

        $entityManager->persist($task);
        $entityManager->flush();

        return $this->redirectToRoute('to_do_list');
    }

    /**
     * @Route("/update/{id}", name="update_status")
     */
    public function update(Request $request): Response
    {
        $id = $request->get('id');
        $entityManager = $this->registry->getManager();
        $task = $entityManager->getRepository(Task::class)->find($id);

        $task->setStatus(!$task->isStatus());
        $entityManager->flush();

        return $this->redirectToRoute('to_do_list');
    }

    /**
     * @Route("/delete/{id}", name="delete_task")
     */
    public function delete(Task $id): Response
    {
        $entityManager = $this->registry->getManager();

        $entityManager->remove($id);
        $entityManager->flush();

        return $this->redirectToRoute('to_do_list');
    }
}
