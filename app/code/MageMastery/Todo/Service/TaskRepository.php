<?php

namespace MageMastery\Todo\Service;

use MageMastery\Todo\Api\Data\TaskInterface;
use MageMastery\Todo\Api\Data\TaskSearchResultInterface;
use MageMastery\Todo\Api\Data\TaskSearchResultInterfaceFactory;
use MageMastery\Todo\Api\TaskRepositoryInterface;
use MageMastery\Todo\Model\ResourceModel\Task;
use MageMastery\Todo\Model\TaskFactory;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     * @var Task
     */
    private Task $resource;

    /**
     * @var TaskFactory;
     */
    private TaskFactory $taskFactory;
    /**
     * @var  TaskSearchResultInterfaceFactory
     * */
    private TaskSearchResultInterfaceFactory $searchResultsFactory;
    /**
     * @var  TaskSearchResultInterfaceFactory
     * */
    /**
     * @var CollectionProcessorInterface
     * */
    private CollectionProcessorInterface $collectionProcessor;

    /**
     * TaskRepository constructor.
     * @param Task $resource
     * @param TaskFactory $taskFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param TaskSearchResultInterfaceFactory $searchResultFactory
     */

    public function __construct(
        Task $resource,
        TaskFactory $taskFactory,
        CollectionProcessorInterface $collectionProcessor,
        TaskSearchResultInterfaceFactory $searchResultFactory
    ) {
        $this->resource = $resource;
        $this->taskFactory = $taskFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultsFactory = $searchResultFactory;
    }

    public function getList(SearchCriteriaInterface $searchCriteria): TaskSearchResultInterface
    {
        $searchResult = $this->searchResultsFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $this->collectionProcessor->process($searchCriteria, $searchResult);

        return $searchResult;
    }

    public function get($taskId):TaskInterface
    {
        $object = $this->taskFactory->create();
        $this->resource->load($object, $taskId);
        return $object;
    }
}
