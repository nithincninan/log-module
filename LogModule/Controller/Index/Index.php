<?php
declare(strict_types=1);

namespace Magento\LogModule\Controller\Index;

use Psr\Log\LoggerInterface as PsrLoggerInterface;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Index implements HttpGetActionInterface
{
    private PsrLoggerInterface $logger;
    private PageFactory $pageFactory;

    public function __construct(
        PsrLoggerInterface $logger,
        PageFactory $pageFactory
    ) {
        $this->logger = $logger;
        $this->pageFactory = $pageFactory;
    }

    public function execute()
    {
        $this->logger->info('This is a custom log message.');
        return $this->pageFactory->create();
    }
}