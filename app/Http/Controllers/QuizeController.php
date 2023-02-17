<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\BaseModel;
use App\Services\QuizeService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QuizeController extends BaseController
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    /**
    * @var QuizeService
    */
    private $quizeService;

    public function __construct(QuizeService $quizeService)
    {
      $this->quizeService = $quizeService;

    }

    public function index()
    {
     echo('Welcome to Quize Trial!!!<br>Developed by Resoft');
    }

    public function createQuiz(Request $request)
    {
      $response = $this->quizeService->createQuiz($request);
      return response()->json($response['response'], $response['status']);
    }
    public function createQuizQuestion(Request $request)
    {
        $response = $this->quizeService->createQuizQuestion($request);
        return response()->json($response['response'], $response['status']);
    }
    public function updateQuizQuestion(Request $request, $id)
    {
        $response = $this->quizeService->updateQuizQuestion($request, $id);
        return response()->json($response['response'], $response['status']);
    }
    public function deleteQuizQuestion( $id)
    {
        $response = $this->quizeService->deleteQuizQuestion($id);
        return response()->json($response['response'], $response['status']);
    }
    public function createQuizAnswers(Request $request)
    {
        $response = $this->quizeService->createQuizAnswers($request);
        return response()->json($response['response'], $response['status']);
    }
    public function submitQuiz(Request $request)
    {
        $response = $this->quizeService->submitQuiz($request);
        return response()->json($response['response'], $response['status']);
    }
    public function getQuiz($id)
    {
      $response = $this->quizeService->getQuiz($id);
      return response()->json($response['response'], $response['status']);
    }


}

 ?>
