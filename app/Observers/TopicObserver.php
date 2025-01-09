<?php

namespace App\Observers;

use App\Models\Topic;
use App\Models\Course;

class TopicObserver
{
    public function saved(Topic $topic)
    {
        $this->updateCourseProgress($topic->course);
    }

    public function deleted(Topic $topic)
    {
        $this->updateCourseProgress($topic->course);
    }

    private function updateCourseProgress(Course $course)
    {
        // Menghitung progress rata-rata dari semua Topics yang ada di Course
        $totalProgress = $course->topics->avg('progress') ?? 0;

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
