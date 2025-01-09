<?php

namespace App\Observers;

use App\Models\Topic;
use App\Models\SubTopic;
use Illuminate\Support\Facades\Log;

class SubTopicObserver
{
    public function saved(SubTopic $subTopic)
    {
        $this->updateTopicProgress($subTopic->topic);
    }

    public function deleted(SubTopic $subTopic)
    {
        $this->updateTopicProgress($subTopic->topic);
    }

    private function updateTopicProgress(Topic $topic)
    {
        $totalProgress = $topic->subTopics->avg('progress') ?? 0;

        // Update progress Topic
        $topic->progress = $totalProgress;

        // // Tentukan status berdasarkan progress
        if ($totalProgress == 0) {
            $topic->status = 'Not Yet';
        } elseif ($totalProgress > 0 && $totalProgress < 100) {
            $topic->status = 'Progress';
        } elseif ($totalProgress == 100) {
            $topic->status = 'Finish';
        }

        $topic->save();

        // Perbarui progress Course
        $this->updateCourseProgress($topic->course);
    }

    private function updateCourseProgress($course)
    {
        // Menghitung progress rata-rata dari semua Topics yang ada di Course
        $totalProgress = $course->topics->avg('progress') ?? 0;

        //dd($totalProgress);
        // // Tentukan status berdasarkan progress
        if ($totalProgress == 0) {
            $course->status = 'Not Yet';
            $course->progress = $totalProgress;
        } elseif ($totalProgress > 0 && $totalProgress < 100) {
            $course->status = 'Progress';
            $course->progress = 25;
        } elseif ($totalProgress == 100) {
            $course->status = 'Finish Production';
            $course->progress = 50;
        }

        $course->save();
    }
}
