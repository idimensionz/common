<?php

namespace iDimensionz\Common\Result;

use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Throwable;

class ResultModel
{
    use LoggerAwareTrait;

    public bool $isSuccess = true;
    /**
     * @var mixed
     */
    public $returnValue = null;
    /**
     * @var string[]|null This can be used to pass back error messages or even caught exception messages.
     */
    protected ?array $errorMessages = [];
    /**
     * Can be used to indicate the exception that was caught.
     */
    public Throwable $exception;

    /**
     * @param bool $isSuccess
     * @param mixed $returnValue
     * @param LoggerInterface|null $logger
     */
    public function __construct(bool $isSuccess = true, $returnValue = null, ?LoggerInterface $logger = null)
    {
        $this->isSuccess = $isSuccess;
        $this->returnValue = $returnValue;
        $this->setLogger($logger);
    }

    /**
     * @param string $errorMessage
     */
    public function addErrorMessage(string $errorMessage)
    {
        $this->errorMessages[] = $errorMessage;
    }

    /**
     * @param string $prefix
     * @param LoggerInterface|null $logger
     * @return bool True when a valid logger is found. False when a valid logger is not found.
     */
    public function logErrorMessages(string $prefix = '', ?LoggerInterface $logger = null): bool
    {
        $logger = $logger ?? $this->logger;

        if ($logger instanceof LoggerInterface) {
            $isValidLogger = true;
            foreach ($this->errorMessages as $errorMessage) {
                $logger->error($prefix . $errorMessage);
            }
        } else {
            $isValidLogger = false;
        }

        return $isValidLogger;
    }
}
