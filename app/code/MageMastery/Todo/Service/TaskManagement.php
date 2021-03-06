<?php

declare(strict_types=1);

namespace MageMastery\Todo\Service;

use MageMastery\Todo\Api\Data\TaskInterface;
use MageMastery\Todo\Api\TaskManagementInterface;
use MageMastery\Todo\Model\ResourceModel\Task;
use Magento\Framework\Exception\AlreadyExistsException;

class TaskManagement implements TaskManagementInterface
{
    private Task $resource;

    public function __construct(Task $resource)
    {
        $this->resource = $resource;
    }

    public function save(TaskInterface $task)
    {
        $this->resource->save($task);
    }

    public function delete(TaskInterface $task)
    {
        $this->resource->delete($task);
    }
}
