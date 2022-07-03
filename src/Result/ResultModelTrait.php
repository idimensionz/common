<?php

namespace iDimensionz\Common\Result;

use Throwable;

trait ResultModelTrait
{
    public static function failureResult(): ResultModel
    {
        return new ResultModel(false);
    }

    public static function failureResultWithMessage(string $message): ResultModel
    {
        $resultModel = static::failureResult();
        $resultModel->addErrorMessage($message);

        return $resultModel;
    }

    public static function failureResultWithException(Throwable $throwable): ResultModel
    {
        $resultModel = static::failureResultWithMessage($throwable->getMessage());
        $resultModel->exception = $throwable;

        return $resultModel;
    }

    public static function successResult(): ResultModel
    {
        return new ResultModel();
    }

    /**
     * @param mixed $returnValue
     */
    public static function successResultWithReturnValue($returnValue): ResultModel
    {
        return new ResultModel(true, $returnValue);
    }
}
