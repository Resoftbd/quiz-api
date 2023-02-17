<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Public Route*/
Route::group(['prefix' => 'v1/', 'middleware' => ['api']], function () {

    Route::get('/quiz/{id}', 'QuizeController@getQuiz');
    Route::post('/quiz', 'QuizeController@createQuiz');
    Route::post('/quiz/question', 'QuizeController@createQuizQuestion');
    Route::put('/quiz/question/{id}', 'QuizeController@updateQuizQuestion');
    Route::delete('/quiz/question/{id}', 'QuizeController@deleteQuizQuestion');
    Route::post('/quiz/answers', 'QuizeController@createQuizAnswers');
    Route::post('/quiz/answers/submit', 'QuizeController@submitQuiz');
});

