<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $user;

    public function signIn($user=null)
    {
        if (!$user) {
            $user = factory(User::class)->create();
        }
        $this->user = $user;

        $this->be($this->user);

        return $this;
    }
}
