<?php

namespace App\Console\Commands;

use App\ActionStatus;
use App\Models\Person;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CheckPopularPersons extends Command
{
    protected $signature = 'persons:check-popularity';
    protected $threshold = 50;
    protected $description = 'Check for persons receiving more than the configured number of likes.';

    public function handle(): int
    {
        $popularPersons = $this->findPopularPersons($this->threshold);

        if ($popularPersons->isEmpty()) {
            $this->info("No persons have exceeded {$this->threshold} likes.");
            return self::SUCCESS;
        }

        $this->table(
            ['ID', 'Name', 'Likes'],
            $popularPersons->map(fn ($person) => [
                $person->id,
                $person->name,
                $person->likes_count,
            ])->all()
        );

        $popularPersons->each(function ($person): void {
            Log::info('Person exceeded like threshold.', [
                'person_id' => $person->id,
                'name' => $person->name,
                'likes' => $person->likes_count,
                'threshold' => $this->threshold,
            ]);
        });

        $this->sendEmailNotification($popularPersons);

        return self::SUCCESS;
    }

    private function findPopularPersons(int $threshold): Collection
    {
        $likeStatus = ActionStatus::LIKE->name;

        return Person::query()
            ->withCount(['actions as likes_count' => fn ($query) => $query->where('status', $likeStatus)])
            ->whereHas('actions', fn ($query) => $query->where('status', $likeStatus), '>', $threshold)
            ->get();
    }

    private function sendEmailNotification(Collection $popularPersons): void
    {
        $recipient = config('mail.admin');

        if (empty($recipient)) {
            $this->warn('No email recipient configured for popularity alerts; skipping email notification.');
            return;
        }

        $subject = 'Popular persons threshold exceeded';
        $summaryLines = $popularPersons->map(function ($person) {
            return sprintf('%s (%s) — %d likes', $person->name, $person->id, $person->likes_count);
        })->implode(PHP_EOL);

        $body = sprintf(
            "The following persons have exceeded the configured like threshold (%d likes):\n\n%s\n",
            $this->threshold,
            $summaryLines
        );

        Mail::raw($body, function ($message) use ($recipient, $subject): void {
            $message->to($recipient)->subject($subject);
        });

        $this->info("Notification email sent to {$recipient}.");
    }
}
