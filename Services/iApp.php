<?php

interface iApp
{
    public function insertApp(AppDTO $app);
    //public function selectApp(AppDTO $app);
    public function selectAppAll();
    public function selectAppType();
    public function selectAppLaboratory();
    public function editApp(AppDTO $app);
    /*public function deletUser(AppDTO $user);*/
	//public function selectTypeData(AppDTO $app,$selection);
}
?>
