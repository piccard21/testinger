<?php

namespace Tests\Feature;

use App\MailTracking;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmailTest extends TestCase
{
    use MailTracking;

    public function testBasicExample()
    {
        $this->visit('/route-that-sends-an-email')
         ->seeEmailWasSent()
         ->seeEmailSubject('Hello World')
         ->seeEmailTo('foo@bar.com')
         ->seeEmailEquals('Click here to buy this jewelry.')
         ->seeEmailContains('Click here');
    }
}
