<?php

namespace Tests\Unit\Models;

use App\Meeting;
use App\Payment;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Collection;
use Tests\TestCase;

class MeetingTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_meeting_has_belongs_to_creator_relation()
    {
        $meeting = factory(Meeting::class)->make();

        $this->assertInstanceOf(User::class, $meeting->creator);
        $this->assertEquals($meeting->creator_id, $meeting->creator->id);
    }

    /** @test */
    public function a_meeting_has_many_payments_relation()
    {
        $meeting = factory(Meeting::class)->create();
        $payment = factory(Payment::class)->create(['meeting_id' => $meeting->id]);

        $this->assertInstanceOf(Collection::class, $meeting->payments);
        $this->assertInstanceOf(Payment::class, $meeting->payments->first());
    }
}