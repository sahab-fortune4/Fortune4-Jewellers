<?php


namespace Jewellers\FormSubmission\Model;

use Jewellers\FormSubmission\Model\ResourceModel\Submission\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magento\Framework\App\RequestInterface;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $collection;
    protected $dataPersistor;
    protected $loadedData;
    protected $request;

    public function __construct(
        $name, 
        $primaryFieldName, 
        $requestFieldName, 
        CollectionFactory $pageCollectionFactory, 
        DataPersistorInterface $dataPersistor, 
        \Magento\Framework\App\Filesystem\DirectoryList $directoryList, 
        \Magento\Store\Model\StoreManagerInterface $storeManager, 
        RequestInterface $request,  // Inject RequestInterface to get URL parameters
        array $meta = [], 
        array $data = [], 
        PoolInterface $pool = null
    ) {
        $this->collection = $pageCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->directoryList = $directoryList;
        $this->storeManager = $storeManager;
        $this->request = $request;  // Store the request to use in getData()

        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    // Main method to fetch data for the form
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        // Get the 'id' parameter from the URL (for Edit mode)
        $entity_id = $this->request->getParam('entity_id');
        
        // If an ID is provided, load the corresponding record
        if ($entity_id) {
            $model = $this->collection->getItemById($entity_id);
            if ($model) {
                $this->loadedData[$model->getId()] = $model->getData();
                // if (isset($data['product_id'])) {
                //     $this->loadedData[$model->getId()]["data"]["products"] = (string) $data['product_id']; // Ensure it's a string
                // }
                
                // $this->loadedData[$model->getId()]["data"]["products"] = ["123","456"];
            }
        } else {
            // If no ID, return an empty array for Add New scenario
            $this->loadedData[] = [];
        }
        return $this->loadedData;
    }

  
}
