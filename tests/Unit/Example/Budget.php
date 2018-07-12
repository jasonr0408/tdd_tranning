<?php
namespace Tests\Unit\Example;
use Tests\Unit\Example\BudgetRepository;

class Budget
{
    private $oBudgetRepository;
    public function __construct(BudgetRepository $_oBudgetRepository)
    {
        $this->oBudgetRepository = $_oBudgetRepository;
    }

    private function getMoney($_iYear, $_iMonth)
    {
        $aBudgetList = $this->oBudgetRepository->getAllBudget();
        $iMoney = array_key_exists($_iMonth, $aBudgetList[$_iYear]) ? $aBudgetList[$_iYear][$_iMonth] : 0;

        return $iMoney;
    }

    public function calculateMoney(string $sStart, string $sEnd): int
    {
        $iTotalBudge = 0;
        $aStart = explode('-', $sStart);
        $aEnd = explode('-', $sEnd);
        $iStartYear = (int) $aStart[0];
        $iStartMonth = (int) $aStart[1];
        $iStartday = (int) $aStart[2];
        $iEndYear = (int) $aEnd[0];
        $iEndMonth = (int) $aEnd[1];
        $iEndday = (int) $aEnd[2];

        for ($iYear = $iStartYear; $iYear <= $iEndYear; $iYear++) {
            # 同年同月
            if ($iStartMonth === $iEndMonth) {
                $iMoney = $this->getMoneyInMonth($iYear, $iStartMonth, $iStartday, $iEndday);
                return $iMoney;
            }

            # 有三種情況 頭月 中間月 尾月
            for ($iMonth = $iStartMonth; $iMonth <= $iEndMonth; $iMonth++) {
                if ($iMonth == $iStartMonth) {
                    $iDayCount = date("t", strtotime($iYear . '-' . $iMonth));
                    $iMoney = $this->getMoneyInMonth($iYear, $iStartMonth, $iStartday, $iDayCount);
                } elseif ($iMonth == $iEndMonth) {
                    $iMoney = $this->getMoneyInMonth($iYear, $iMonth, 1, $iEndday);
                } else {
                    $iDayCount = date("t", strtotime($iYear . '-' . $iMonth));
                    $iMoney = $this->getMoneyInMonth($iYear, $iMonth, 1, $iDayCount);
                }

                $iTotalBudge += $iMoney;
            }
        }

        return $iTotalBudge;
    }

    /**
     * @param $iYear
     * @param $iMonth
     * @param $iStartday
     * @param $iEndday
     * @return int
     */
    private function getMoneyInMonth(int $iYear, int $iMonth, int $iStartday, int $iEndday) :int
    {
        $iTotalDay = $iEndday - $iStartday + 1;
        $iDayCount = date("t", strtotime($iYear . '-' . $iMonth));
        $iMoney = $this->getMoney($iYear, $iMonth) / $iDayCount * $iTotalDay;
        return $iMoney;
    }

}
