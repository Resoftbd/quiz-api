<?php

namespace App\Services;

use App;
use App\Contracts\Repositories\QuizeRepository;
use App\Contracts\Repositories\QuestionRepository;
use App\Contracts\Repositories\AnswerRepository;
use App\Contracts\Repositories\SubmitRepository;
use App\Contracts\Services\QuizeContact;
use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
class QuizeService implements QuizeContact
{

    /**
     * @var QuizeRepository
     */
    private $quizeRepository;

    /**
     * @var QuestionRepository
     */
    private $questionRepository;

    /**
     * @var AnswerRepository
     */
    private $answerRepository;

    /**
     * @var SubmitRepository
     */
    private $submitRepository;

    public function __construct(
                            QuizeRepository $quizeRepository,
                            QuestionRepository $questionRepository,
                            AnswerRepository $answerRepository,
                            SubmitRepository $submitRepository
                        )
    {
        $this->quizeRepository = $quizeRepository;
        $this->questionRepository = $questionRepository;
        $this->answerRepository = $answerRepository;
        $this->submitRepository = $submitRepository;
    }
    public function getQuiz($id)
    {
        $response ['response']= [
            'success' => false,
        ];
        $response ['status']= BaseModel::CODE_BAD_REQUEST;
        $quiz = $this->quizeRepository->getById($id);
        if(!$quiz){
            $response['response']['message'] = 'Quiz Not Found!';
            return $response;
        }
        $questions = $this->questionRepository->getQuestionAndAnswers($id);
        if($questions){
            $response = [
                'response' =>[
                    'message' => 'Quiz Found!',
                    'data' => ['quiz' => $quiz,'questions' => $questions],
                    'success' => true
                ] ,
                'status' => BaseModel::CODE_OK
            ];
        }else{
            $response = [
                'response' =>[
                    'message' => 'Failed to create Quiz!',
                    'data' => [],
                    'success' => false
                ] ,
                'status' => BaseModel::CODE_UNPROCESSABLE_ENTITY
            ];
        }
        return $response;
    }
    public function createQuiz($request)
    {
        $response ['response']= [
            'success' => false,
        ];
        $response ['status']= BaseModel::CODE_BAD_REQUEST;

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'description' => 'required',
        ]);
        if($validator->fails()){
            $response['response']['message'] = $validator->getMessageBag()->first();
            return $response;
        }
        $insertData = [
            'name' => trim($request['name']),
            'description' => trim($request['description'])
        ];
        $data =  $this->quizeRepository->insertNewRecord($insertData);
        if($data){
            $response = [
                'response' =>[
                    'message' => 'Successfully created Quiz!',
                    'data' => $data,
                    'success' => true
                ] ,
                'status' => BaseModel::CODE_CREATED
            ];
        }else{
            $response = [
                'response' =>[
                    'message' => 'Failed to create Quiz!',
                    'data' => $data,
                    'success' => false
                ] ,
                'status' => BaseModel::CODE_UNPROCESSABLE_ENTITY
            ];
        }
        return $response;
    }
    public function createQuizQuestion($request)
    {
        $response ['response']= [
            'success' => false,
        ];
        $response ['status']= BaseModel::CODE_BAD_REQUEST;

        $validator = Validator::make($request->all(),[
            'quizId' => 'required',
            'question' => 'required',
        ]);
        if($validator->fails()){
            $response['response']['message'] = $validator->getMessageBag()->first();
            return $response;
        }
        $insertData = [
            'quize_id' => $request['quizId'],
            'question' => trim($request['question'])
        ];
        $data =  $this->questionRepository->insertNewRecord($insertData);
        if($data){
            $response = [
                'response' =>[
                    'message' => 'Successfully created Question!',
                    'data' => $data,
                    'success' => true
                ] ,
                'status' => BaseModel::CODE_CREATED
            ];
        }else{
            $response = [
                'response' =>[
                    'message' => 'Failed to create Question!',
                    'data' => $data,
                    'success' => false
                ] ,
                'status' => BaseModel::CODE_UNPROCESSABLE_ENTITY
            ];
        }
        return $response;
    }
    public function updateQuizQuestion($request, $id)
    {
        $response ['response']= [
            'success' => false,
        ];
        $response ['status']= BaseModel::CODE_BAD_REQUEST;

        $validator = Validator::make($request->all(),[
            'question' => 'required',
        ]);
        if($validator->fails()){
            $response['response']['message'] = $validator->getMessageBag()->first();
            return $response;
        }
        $question = $this->questionRepository->getById($id);
        if(!$question) {
            $response['response']['message'] = 'Questions Not found!';
            return $response;
        }
        $updateData = [
            'question' => trim($request['question'])
        ];
        $data =  $this->questionRepository->updateById($updateData, $id);
        if($data){
            $response = [
                'response' =>[
                    'message' => 'Successfully updated Question!',
                    'data' => $data,
                    'success' => true
                ] ,
                'status' => BaseModel::CODE_ACCEPTED
            ];
        }else{
            $response = [
                'response' =>[
                    'message' => 'Failed to update Question!',
                    'data' => $data,
                    'success' => false
                ] ,
                'status' => BaseModel::CODE_UNPROCESSABLE_ENTITY
            ];
        }
        return $response;
    }
    public function deleteQuizQuestion($id)
    {
        $response ['response']= [
            'success' => false,
        ];
        $response ['status']= BaseModel::CODE_BAD_REQUEST;

        $question = $this->questionRepository->getById($id);
        if(!$question) {
            $response['response']['message'] = 'Questions Not found!';
            return $response;
        }
        $data =  $this->questionRepository->deleteById($id);
        if($data){
            $response = [
                'response' =>[
                    'message' => 'Successfully deleted Question!',
                    'data' => $data,
                    'success' => true
                ] ,
                'status' => BaseModel::CODE_ACCEPTED
            ];
        }else{
            $response = [
                'response' =>[
                    'message' => 'Failed to delete Question!',
                    'data' => $data,
                    'success' => false
                ] ,
                'status' => BaseModel::CODE_UNPROCESSABLE_ENTITY
            ];
        }
        return $response;
    }
    public function createQuizAnswers($request)
    {
        $response ['response']= [
            'success' => false,
        ];
        $response ['status']= BaseModel::CODE_BAD_REQUEST;

        $validator = Validator::make($request->all(),[
            'quizId' => 'required',
            'questionId' => 'required',
            'answers' => 'required',
        ]);
        if($validator->fails()){
            $response['response']['message'] = $validator->getMessageBag()->first();
            return $response;
        }
        $insertData = [];
        $quiz = $this->questionRepository->getById($request['quizId']);
        if(!$quiz) {
            $response['response']['message'] = 'Quiz Not found!';
            return $response;
        }
        $question = $this->questionRepository->getById($request['questionId']);
        if(!$question) {
            $response['response']['message'] = 'Questions Not found!';
            return $response;
        }
        if(count($request['answers'] ) == 0) {
            $response['response']['message'] = 'Answers is required and cannot be empty!';
            return $response;
        }
        foreach ($request['answers'] as $key => $answer) {
            $insertData[] = [
                'quize_id' => $request['quizId'],
                'question_id' => $request['questionId'],
                'answer' => trim($answer['value']),
                'is_right_answer' => $answer['isRightAnswer'] ? 1 : 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }
        $data =  $this->answerRepository->bulkInsert($insertData);
        if($data){
            $response = [
                'response' =>[
                    'message' => 'Successfully created Answers!',
                    'data' => $data,
                    'success' => true
                ] ,
                'status' => BaseModel::CODE_CREATED
            ];
        }else{
            $response = [
                'response' =>[
                    'message' => 'Failed to create Answers!',
                    'data' => $data,
                    'success' => false
                ] ,
                'status' => BaseModel::CODE_UNPROCESSABLE_ENTITY
            ];
        }
        return $response;
    }

    public function submitQuiz($request)
    {
        $response ['response']= [
            'success' => false,
        ];
        $response ['status']= BaseModel::CODE_BAD_REQUEST;

        $validator = Validator::make($request->all(),[
            'quizId' => 'required',
            'questionId' => 'required',
            'answerId' => 'required',
            'submissionEmail' => 'required',
        ]);
        if($validator->fails()){
            $response['response']['message'] = $validator->getMessageBag()->first();
            return $response;
        }
        $quiz = $this->questionRepository->getById($request['quizId']);
        if(!$quiz) {
            $response['response']['message'] = 'Quiz Not found!';
            return $response;
        }
        $question = $this->questionRepository->getById($request['questionId']);
        if(!$question) {
            $response['response']['message'] = 'Questions Not found!';
            return $response;
        }
        $answer = $this->answerRepository->getByWhereFirst([
            'id'=>$request['answerId'],
            'question_id'=>$request['questionId']]);
        if(!$answer) {
            $response['response']['message'] = 'Answer Not found!';
            return $response;
        }

        $insertData = [
            'quize_id' => $request['quizId'],
            'question_id' => $request['quizId'],
            'answer_id' => $request['quizId'],
            'is_right_answer' => $answer['is_right_answer'],
            'submission_email' => trim($request['submissionEmail'])
        ];
        $data =  $this->submitRepository->insertNewRecord($insertData);
        if($data){
            $message = $answer['is_right_answer'] ==1 ? 'Answer is correct!' : 'Wrong Answer!';
            $response = [
                'response' =>[
                    'message' => $message,
                    'data' => $data,
                    'success' => true
                ] ,
                'status' => BaseModel::CODE_CREATED
            ];
        }else{
            $response = [
                'response' =>[
                    'message' => 'Failed to submit Answer!',
                    'data' => $data,
                    'success' => false
                ] ,
                'status' => BaseModel::CODE_UNPROCESSABLE_ENTITY
            ];
        }
        return $response;
    }


}
