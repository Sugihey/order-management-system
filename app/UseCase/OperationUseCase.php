<?php
namespace App\UseCase;
use App\Models\Operation;


class OperationUseCase
{
    public static function getOperationsAll(){
        return Operation::orderBy('sort')->get();
    }
}
