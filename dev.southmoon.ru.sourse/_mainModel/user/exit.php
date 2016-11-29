<?php


cmfLoad('basket/cmfBasket');
$user = cmfRegister::getUser();
$user->filterIsUser();
$user->logOut();
cmfRedirect(cmfGetUrl('/user/enter/'));

?>