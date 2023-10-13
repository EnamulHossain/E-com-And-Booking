<?php

namespace App\Concerns;

trait Rating
{
    protected $ratingHtml = "";

    public function getRatingView()
    {
        for ($i=1; $i <= 5; $i++) { 
            $this->ratingHtml .= "<button type='button' class='btn btn-sm ".($this->rate >= $i ? 'button-orange' : 'btn-default')."' aria-label='Left Align'>
            <span><i class='fa-solid fa-star fa'></i></span> </button>";
        }

        return $this->ratingHtml;
    }
}