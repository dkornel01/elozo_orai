<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class BookTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testSimpleGet(): void
    {
        $response = $this->get('/api/books');

        $response->assertStatus(200);
    }
    public function testSimplePost()
        {
            $response = $this->post('/api/books', ['author'=>'egy','title'=>'ketto']);
            $response->assertStatus(200);
        }
    public function testBookId() : void 
    {
        //a make nem rögzíti az adatbázisban a felh-t
        $book = Book::factory()->make();
        $this->withoutMiddleware()->get('/api/books/' . $book->book_id)
        ->assertStatus(200);
    }
    public function testUserIdAuth() : void {
        $this->withoutExceptionHandling(); 
        // create rögzíti az adatbázisban a felh-t
        $user = User::factory()->create();
                    $response = $this->actingAs($user)->get('/api/users/' . $user->id);
                    $response->assertStatus(200);
            }
                
}
