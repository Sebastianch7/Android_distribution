<?php

interface iUser
{
    public function insertUser(UserDTO $user);
    public function selectUser(UserDTO $user);
    public function selectUserAll();
    public function selectUserRoll();
    public function editUser(UserDTO $user);
    /*public function deletUser(UserDTO $user);*/
	public function selectTypeData(UserDTO $user,$selection);
}
?>