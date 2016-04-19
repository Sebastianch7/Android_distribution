<?php

interface iPermission
{
    public function insertPermission(permissionDTO $permission);
    //public function selectApp(AppDTO $app);
    public function selectPermissionAll();
    //public function selectAppType();
    //public function selectAppLaboratory();
    public function editPermission(permissionDTO $permission);
    /*public function deletUser(AppDTO $user);*/
	//public function selectTypeData(AppDTO $app,$selection);
}
?>
