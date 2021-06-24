<?php
declare(strict_types=1);

namespace MageMastery\Todo\Api;

/**
 *  @api
 */
interface TaskStatusManagementInterface
{
    /**
     * @param $taskId
     * @param $status
     * @return bool
     */
    public  function  change($taskId, $status): bool;
}
