<?php
namespace SampleToDo\ToDo\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use SampleToDo\ToDo\Entity\Task as Entity;

class Task
{
    public function add(Request $request, Application $application)
    {
        $mapper = $application['mapper']['task'];
        $task = new Entity;
        $task->setTitle($request->get('title'));
        $task->setDescription($request->get('description'));
        $transaction = $mapper->save($task);
        $_SESSION['success'] = (bool)$transaction;
        $subRequest = Request::create('/', 'GET');
        return $application->handle($subRequest, HttpKernelInterface::SUB_REQUEST);
    }

    public function done(Request $request, Application $application)
    {
        $mapper = $application['mapper']['task'];
        $task = $mapper->findByIdentifier($request->get("task-id"));
        $task->setDone();
        $mapper->save($task);
        return $application->redirect('/');
    }

    public function undone(Request $request, Application $application)
    {
        $mapper = $application['mapper']['task'];
        $task = $mapper->findByIdentifier($request->get("task-id"));
        $task->setUndone();
        $mapper->save($task);
        return $application->redirect('/');
    }
}