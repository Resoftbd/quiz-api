<?php

namespace App\Contracts\Services;

interface QuizeContact
{
    public function createQuiz($request);
    public function createQuizQuestion($request);
    public function createQuizAnswers($request);
    public function submitQuiz($request);

}
