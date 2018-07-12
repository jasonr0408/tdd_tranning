<?php
namespace Tests\Unit\Example;

class Budget
{
    private function getRepostiroyMoney($_iYear, $_iMonth)
    {
        $aBudgetList = array(
            2018 => array(
                5 => 3100,
                6 => 3000,
                7 => 3100,
            ),
        );
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
                    $iTotalDay = $iDayCount - $iStartday + 1;
                    $iMoney = $this->getRepostiroyMoney($iYear, $iMonth) / $iDayCount * $iTotalDay;
                } elseif ($iMonth == $iEndMonth) {
                    $iTotalDay = $iEndday;
                    $iMoney = $this->getRepostiroyMoney($iYear, $iMonth) / $iDayCount * $iTotalDay;
                } else {
                    $iMoney = $this->getRepostiroyMoney($iYear, $iMonth);
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
     * @return float|int
     */
    private function getMoneyInMonth($iYear, $iMonth, $iStartday, $iEndday)
    {
        $iTotalDay = $iEndday - $iStartday + 1;
        $iDayCount = date("t", strtotime($iYear . '-' . $iMonth));
        $iMoney = $this->getRepostiroyMoney($iYear, $iMonth) / $iDayCount * $iTotalDay;
        return $iMoney;
    }


}
