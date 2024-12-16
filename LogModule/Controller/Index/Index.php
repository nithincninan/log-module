<?php
declare(strict_types=1);

namespace Magento\LogModule\Controller\Index;

use Psr\Log\LoggerInterface as PsrLoggerInterface;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Serialize\SerializerInterface;

class Index implements HttpGetActionInterface
{
    private PsrLoggerInterface $logger;
    private PageFactory $pageFactory;
    private SerializerInterface $serializer;

    public function __construct(
        PsrLoggerInterface $logger,
        PageFactory $pageFactory,
        SerializerInterface $serializer
    ) {
        $this->logger = $logger;
        $this->pageFactory = $pageFactory;
        $this->serializer = $serializer;
    }

    public function execute()
    {
        // Log a string
        $this->logger->info('This is a custom log message.');

        // Log an array
        $data = ['key1' => 'value1', 'key2' => 'value2'];
        $serializedData = $this->serializer->serialize($data); // Serialize the Data
        $this->logger->info('Serialized Data: ' . $serializedData); // Log the Serialized Data

        return $this->pageFactory->create();
    }
}