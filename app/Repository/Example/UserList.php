<?php
namespace App\Repository\Example;
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

        return $aUserData;
    }


}
