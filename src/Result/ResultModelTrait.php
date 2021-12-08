<?php

namespace iDimensionz\Common\Result;

use Throwable;

trait ResultModelTrait
{
    public function failureResult(): ResultModel
    {
        return new ResultModel(false);
    }

    public function failureResultWithMessage(string $message): ResultModel
    {
        $resultModel = $this->failureResult();
        $resultModel->addErrorMessage($message);

        return $resultModel;
    }

    public function failureResultWithException(Throwable $throwable): ResultModel
    {
        $resultModel = $this->failureResultWithMessage($throwable->getMessage());
        $resultModel->exception = $throwable;

        return $resultModel;
    }

    public function successResult(): ResultModel
    {
        return new ResultModel();
    }

    /**
     * @param mixed $returnValue
     */
    public function successResultWithReturnValue($returnValue): ResultModel
    {
        return $this->successResult(true, $returnValue);
    }
}
