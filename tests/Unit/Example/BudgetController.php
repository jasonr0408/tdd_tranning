<?php
namespace Tests\Unit\Example;

use Request;
use Tests\Unit\Example\BudgetInterface;
use Validator;

class BudgetController
{
    private $oBudgetService;
    public function __construct(BudgetInterface $_oBudgetService)
    {
        $this->oBudgetService = $_oBudgetService;
    }
    public function getBudget(Request $_oRequest)
    {
        $oValidate = Validator::make($_oRequest->all(), [
            'StartDate' => 'required|string',
            'EndDate' => 'required|string',
        ]);

        if ($oValidate->fails()) {
            return $oValidate->errors()->all();
        }

        $iBudget = $this->oBudgetService->calculateMoney();

        return response()->json(['result' => true, 'data' => array('Budget' => $iBudget)]);
    }
}
