<?php
namespace Tests\Unit\Example;
use Tests\Unit\Example\BudgetRepository;
use Tests\Unit\Example\BudgetInterface;

class BudgetService implements BudgetInterface
{
    private $oBudgetRepository;
    public function __construct(BudgetRepository $_oBudgetRepository)
    {
        $this->oBudgetRepository = $_oBudgetRepository;
    }

    private function getMoney(int $_iYear, int $_iMonth) :int
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
            # 有四種情況 前後同年 開始年 結束年 中間年
            if ($iStartYear === $iEndYear) {
                # 同年同月
                if ($iStartMonth === $iEndMonth) {
                    $iTotalBudge = $this->getMoneyInMonth($iYear, $iStartMonth, $iStartday, $iEndday);
                    # 快速return
                    return $iTotalBudge;
                }

                # 有三種情況 頭月 尾月 中間月
                # 中間月
                $iTotalBudge += $this->getMoneyInYear($iYear, $iStartMonth + 1, $iEndMonth - 1);
                $iDayCount = date("t", strtotime($iYear . '-' . $iStartMonth));
                $iTotalBudge += $this->getMoneyInMonth($iYear, $iStartMonth, $iStartday, $iDayCount);
                $iTotalBudge += $this->getMoneyInMonth($iYear, $iEndMonth, 1, $iEndday);

                return $iTotalBudge;
            }
            # 第一年
            if ($iYear === $iStartYear) {
                # 拆成兩種情況 第一個月 跟後面的月分
                $iDayCount = date("t", strtotime($iYear . '-' . $iStartMonth));
                $iTotalBudge += $this->getMoneyInMonth($iYear, $iStartMonth, $iStartday, $iDayCount);
                $iTotalBudge += $this->getMoneyInYear($iYear, $iStartMonth + 1, 12);
            }

            # 最後一年
            if ($iYear === $iEndYear) {
                # 拆成兩種情況 最後一個月 跟前面的月分
                $iTotalBudge += $this->getMoneyInMonth($iYear, $iEndMonth, 1, $iEndday);
                $iTotalBudge += $this->getMoneyInYear($iYear, 1, $iEndMonth - 1);
            }

            # 中間的
            if ($iYear !== $iStartYear && $iYear !== $iEndYear) {
                $iTotalBudge += $this->getMoneyInYear($iYear, 1, 12);
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
    private function getMoneyInMonth(int $iYear, int $iMonth, int $iStartday, int $iEndday): int
    {
        $iTotalDay = $iEndday - $iStartday + 1;
        $iDayCount = date("t", strtotime($iYear . '-' . $iMonth));
        $iMoney = $this->getMoney($iYear, $iMonth) / $iDayCount * $iTotalDay;

        return $iMoney;
    }

    private function getMoneyInYear(int $_iYear, int $_iStartMonth, int $_iEndMonth): int
    {
        $iTotalBudge = 0;
        for ($iMonth = $_iStartMonth; $iMonth <= $_iEndMonth; $iMonth++) {
            $iDayCount = date("t", strtotime($_iYear . '-' . $iMonth));
            $iTotalBudge += $this->getMoneyInMonth($_iYear, $iMonth, 1, $iDayCount);
        }

        return $iTotalBudge;
    }

}
