<?php
namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Http\Controllers\Admin\Session;
use Mockery;
use Illuminate\Http\Request;

class SessionTest extends TestCase
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

    public function testSessionCase1()
    {
        $_Request = Mockery::mock(Request::class);
        $_Request->shouldReceive('input')
            ->withAnyArgs()
            ->andReturn(array(
                'username' => 'jr',
                'password' => 'qwe123',
            ));
        $oSession = new Session();
        $aResult = $oSession->login($_Request);
        $aEecepted = response()->json(['result' => true, 'data' => 'login succeed']);

        $this->assertEquals($aEecepted, $aResult);

    }

}
