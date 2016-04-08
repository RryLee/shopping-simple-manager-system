<?php

use Market\Models\User;

class AUserSeed
{
    public function run()
    {
        $user = new User;
        $user->username = '超级管理员';
        $user->email = 'super@super.com';
        // 123456
        $user->password = '$2y$10$/AGLK8RmBMM7cpzWZ3vu0eaWUmLaVjDBSGa1FlUkYXOFc1HvxraFG';
        $user->issuper = true;

        $user->save();

        $user = new User;
        $user->username = '管理员';
        $user->email = 'admin@admin.com';
        // 123456
        $user->password = '$2y$10$/AGLK8RmBMM7cpzWZ3vu0eaWUmLaVjDBSGa1FlUkYXOFc1HvxraFG';
        $user->issuper = false;

        $user->save();
    }
}
