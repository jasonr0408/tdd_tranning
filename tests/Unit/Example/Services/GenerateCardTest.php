<?php
namespace Tests\Unit\Services;

use App\Facades\Example\RandomFacade;
use App\Model\User\UserList as UserListModel;
use App\Repositories\Example\UserList;
use App\Services\Example\GenerateCard;
use Tests\TestCase;
use Mockery;

class GenerateCardTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    public function testGetUserData()
    {
        ## 1a
        ## 手動注入
        $oUserList = Mockery::mock(UserList::class);
        $oUserList->shouldReceive('getUserData')
            ->once()
            ->withAnyArgs()
            ->andReturn(array(
                'MemberId' => 1,
                'UserName' => 'jr',
                'Passwd' => 'qwe123',
                'NickName' => 'jr',
                'Level' => 1,
                'test' => true,
            ));
        $oGenerateCard = new GenerateCard($oUserList);
        ## 2a
        $iResult = $oGenerateCard->getUserData();
        $aEecepted = array(
            'MemberId' => 1,
            'UserName' => 'jr',
            'Passwd' => 'qwe123',
            'NickName' => 'jr',
            'Level' => 1,
            'test' => true,
        );
        ## 3a
        $this->assertEquals($aEecepted, $iResult);
    }

    public function testGenerate()
    {
        ## 1a
        ## 把facade替換掉
        RandomFacade::shouldReceive('rand')
            ->with(1, 10)
            ->andReturn(5);
        $oUserListModel = new UserListModel;
        $oUserList = new UserList($oUserListModel);
        $oGenerateCard = new GenerateCard($oUserList);
        ## 2a
        $iResult = $oGenerateCard->generate();
        $iEecepted = 6;
        ## 3a
        $this->assertEquals($iEecepted, $iResult);
    }
}
