<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
        public function testHomePage(){
        $response = $this->get('/');
        $response->assertSeeText('Home page of the website');
    }
        public function testPrice(){
        $response = $this->get('/price');
        $response->assertSeeText('Price list of the products');
    }

}
