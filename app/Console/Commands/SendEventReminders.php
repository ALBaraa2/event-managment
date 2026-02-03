<?php

namespace App\Console\Commands;

use App\Models\Event;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SendEventReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-event-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders for upcoming events to attendees';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $events = Event::with('attendees.user')
            ->whereBetween('start_time', [now(), now()->addDay()])
            ->get();

            $eventCount = $events->count();
            $eventLabel = Str::plural('event', $eventCount);

            $events->each(
                fn($event) => $event->attendees->each(
                    fn($attendee) => $this->info("Reminder sent to {$attendee->user->email} for event '{$event->name}' starting at {$event->start_time}.")));
        // $this->info("Found {$eventCount} {$eventLabel}!");
    }
}
