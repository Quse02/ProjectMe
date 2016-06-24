<?php
if(!$user->is_logged_in())
{
    $user->redirect('Login');
}

if($user->is_logged_in()!="")
{
    $user->logout();
    $user->redirect('Main');
}