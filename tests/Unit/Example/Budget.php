<?php
namespace Tests\Unit\Example;

class Budget
{
    private function getRepostiroyMoney($_iYear, $_iMonth)
    {
        $aBudgetList = array(
            2018 => array(
                '05' => 3100,
                '06' => 3000,
                '07' => 3100,
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
        $iStartYear = $aStart[0];
        $iStartMonth = $aStart[1];
        $iStartday = $aStart[2];
        $iEndYear = $aEnd[0];
        $iEndMonth = $aEnd[1];
        $iEndday = $aEnd[2];

        for ($iYear = $iStartYear; $iYear <= $iEndYear; $iYear++) {
            for ($iMonth = $iStartMonth; $iMonth <= $iEndMonth; $iMonth++) {
                // if ($iStartMonth === $iEndMonth) {
                $iTotalDay = $iEndday - $iStartday + 1;
                $iDayCount = date("t", strtotime($iYear . '-' . $iMonth));
                $iMoney = $this->getRepostiroyMoney($iYear, $iMonth) / $iDayCount * $iTotalDay;
                // } elseif ($iMonth === $iStartMonth) {

                // } elseif ($iMonth === $iEndMonth) {

                // } else {
                $iTotalBudge += $iMoney;
                // }
            }
        }

        return $iTotalBudge;
    }
}
