<?php
declare(strict_types=1);

namespace MageMastery\Todo\Service;

use MageMastery\Todo\Api\TaskRepositoryInterface;
use MageMastery\Todo\Api\TaskStatusManagementInterface;
use MageMastery\Todo\Model\Task;

class TaskStatusManagement implements TaskStatusManagementInterface
{
    /**
     * @var TaskRepositoryInterface
     */
    private $repositiry;
    /**
     * @var TaskManagementInterface
     */
    private $management;

    /**
     * TaskStatusManagement constructor.
     * @param TaskRepositoryInterface $taskRepository
     * @param TaskManagementInterface $taskManagement
     */
    public function __construct(TaskRepositoryInterface $taskRepository,
                                TaskManagementInterface $taskManagement)
    {
        $this->management = $taskManagement;
        $this->repositiry = $taskRepository;
    }

    /**
     * @param $taskId
     * @param $status
     * @return bool
     */
    public function change($taskId, $status): bool
    {
        if (!in_arry($status, ['open', 'complete'])) return false;

        $task = $this->repositiry->get($taskId);
        $task->setData(Task::STATUS, $status);

        $this->management->save($task);
        return true;
    }
}
