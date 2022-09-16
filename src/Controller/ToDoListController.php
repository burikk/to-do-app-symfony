<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ToDoListController extends AbstractController
{
    /**
     * @Route("/", name="to_do_list")
     */
    public function index(): Response
    {
        return $this->render('to_do_list/index.html.twig');
    }

    /**
     * @Route("/create", name="create_task", methods={"POST"})
     */
    public function createTask(): Response
    {
        exit('to do');
    }

    /**
     * @Route("/update/{id}", name="update_status")
     */
    public function update($id)
    {
        exit('switch' . $id);
    }

    /**
     * @Route("/delete/{id}", name="delete_task")
     */
    public function delete($id)
    {
        exit('deleted' . $id);
    }
}
