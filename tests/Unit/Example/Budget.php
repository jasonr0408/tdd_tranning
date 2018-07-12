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
            # 有四種情況 前後同年 開始年 結束年 中間年
            if ($iStartYear === $iEndYear) {
                # 同年同月
                if ($iStartMonth === $iEndMonth) {
                    $iMoney = $this->getMoneyInMonth($iYear, $iStartMonth, $iStartday, $iEndday);
                    # 快速return
                    return $iMoney;
                }

                # 有三種情況 頭月 尾月 中間月
                for ($iMonth = $iStartMonth; $iMonth <= $iEndMonth; $iMonth++) {
                    if ($iMonth === $iStartMonth) {
                        $iDayCount = date("t", strtotime($iYear . '-' . $iMonth));
                        $iMoney = $this->getMoneyInMonth($iYear, $iStartMonth, $iStartday, $iDayCount);
                    } elseif ($iMonth === $iEndMonth) {
                        $iMoney = $this->getMoneyInMonth($iYear, $iMonth, 1, $iEndday);
                    } else {
                        $iDayCount = date("t", strtotime($iYear . '-' . $iMonth));
                        $iMoney = $this->getMoneyInMonth($iYear, $iMonth, 1, $iDayCount);
                    }

                    $iTotalBudge += $iMoney;
                }
                return $iTotalBudge;
            }
            # 第一年
            if ($iYear === $iStartYear) {
                # 拆成兩種情況 第一個月 跟後面的月分
                $iDayCount = date("t", strtotime($iYear . '-' . $iStartMonth));
                $iTotalBudge += $this->getMoneyInMonth($iYear, $iStartMonth, $iStartday, $iDayCount);
                for ($iMonth = $iStartMonth + 1; $iMonth <= 12; $iMonth++) {
                    $iDayCount = date("t", strtotime($iYear . '-' . $iMonth));
                    $iTotalBudge += $this->getMoneyInMonth($iYear, $iMonth, 1, $iDayCount);
                }
            }

            # 最後一年
            if ($iYear === $iEndYear) {
                # 拆成兩種情況 最後一個月 跟前面的月分
                $iTotalBudge += $this->getMoneyInMonth($iYear, $iEndMonth, 1, $iEndday);
                for ($iMonth = 1; $iMonth <= $iEndMonth - 1; $iMonth++) {
                    $iDayCount = date("t", strtotime($iYear . '-' . $iMonth));
                    $iTotalBudge += $this->getMoneyInMonth($iYear, $iMonth, 1, $iDayCount);
                }
            }

            # 中間的
            if ($iYear !== $iStartYear && $iYear !== $iEndYear) {
                for ($iMonth = 1; $iMonth <= 12; $iMonth++) {
                    $iDayCount = date("t", strtotime($iYear . '-' . $iMonth));
                    $iTotalBudge += $this->getMoneyInMonth($iYear, $iMonth, 1, $iDayCount);
                }
            }

            // $iTotalBudge += $iMoney;
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

}
