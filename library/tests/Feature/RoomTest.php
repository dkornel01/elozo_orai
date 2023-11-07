<?php

namespace Tests\Feature;

use App\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoomTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function testHas(): void{
        $room=new Room(["Bonnie", "Clyde"]);
        $this->assertTrue($room->has('Bonnie'));
    }
    public function testdontHas(): void{
        $room=new Room(["Bonnie", "Clyde"]);
        $this->assertFalse($room->has('David'));
    }
    public function testContains(): void{
        $room=new Room(["Clyde"]);
        $this->assertContains("Bonnie", $room->add("Bonnie"));
    }
    public function testCount(): void{
        $room=new Room(["Clyde","Bonnie"]);
        $this->assertCount(1,$room->remove("Bonnie"));
    }
    public function testRemove(): void{
        $room=new Room(["Clyde","Bonnie"]);
        $this->assertCount(1,$room->remove("Bonnie"));
        $room->remove("Clyde");
        $this->assertNull($room->takeOne());
    }
}
