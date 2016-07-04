<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
  use DatabaseTransactions;

  public function testVisitHomepageWhenNotLoggedIn()
  {
    $this->visit('/')
         ->seePageIs('login')
         ->see('Sign in to start your session')
         ->press('Sign In')
         ->seePageIs('login');
  }

  public function testLoginWithExistingUser()
  {
    $this->visit('/')
         ->see('Sign in to start your session')
         ->type('terry@pixelcandy.co.za', 'email')
         ->type('secret', 'password')
         ->press('Sign In')
         ->seePageIs('/')
         ->see('You are logged in');
  }
}
