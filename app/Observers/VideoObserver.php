<?php

namespace App\Observers;

use App\Models\Video;

class VideoObserver
{
    public function saved(Video $video)
    {
        $this->updateSubTopicProgress($video->subTopic);
    }


    public function deleted(Video $video)
    {
        $this->updateSubTopicProgress($video->subTopic);
    }

    private function updateSubTopicProgress($subTopic)
    {
        if (!$subTopic) {
            return;
        }

        $pptProgress = $subTopic->ppts->avg('progress') ?? 0;
        $videoProgress = $subTopic->videos->avg('progress') ?? 0;

        $totalProgress = ($pptProgress + $videoProgress) / 2;

        $subTopic->progress =  $totalProgress;
        // // Tentukan status berdasarkan progress
        if ($totalProgress == 0) {
            $subTopic->status = 'Not Yet';
        } elseif ($totalProgress > 0 && $totalProgress < 100) {
            $subTopic->status = 'Progress';
        } elseif ($totalProgress == 100) {
            $subTopic->status = 'Finish';
        }

        $subTopic->save();
    }
}
