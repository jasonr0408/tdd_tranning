<?php
namespace App\Repositories\Example;
use App\Model\User\UserList as UserListModel;

class UserList
{
    private $oUserListModel;

    public function __construct(UserListModel $_oUserListModel)
    {
        $this->oUserListModel = $_oUserListModel;
    }

    public function getUserData()
    {
        $aUserData = $this->oUserListModel->where('UserName', 'jr')->get()->first()->toArray();
        $aUserData['test'] = true;

        return $aUserData;
    }
}
