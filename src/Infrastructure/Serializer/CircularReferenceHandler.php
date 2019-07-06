<?php

namespace App\Infrastructure\Serializer;

use App\Domain\Model\Note;
use App\Domain\Model\Task;
use App\Domain\Model\TaskList;
use Symfony\Component\Routing\RouterInterface;

class CircularReferenceHandler
{
    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }
    
    public function __invoke($object)
    {
        switch ($object) {
            case $object instanceof TaskList:
                return $this->router->generate('get_list', ['list' => $object->getId()]);
            case $object instanceof Task:
                return $this->router->generate('get_task', ['task' => $object->getId()]);
            case $object instanceof Note:
                return $this->router->generate('get_note', ['note' => $object->getId()]);
        }
        return $object->getId();
    }
}