<?php


namespace App\Repositories;

use App;
use App\Contracts\Repositories\QuestionRepository;
use App\Models\Question;
use Carbon\Carbon;
use Prettus\Repository\Eloquent\BaseRepository;

class QuestionRepositoryEloquent extends BaseRepository implements QuestionRepository
{
  public function model()
  {
      return Question::class;
  }

    public function getAll()
    {
        return $this->model
            ->orderBy('id','desc')
            ->get();
    }

    public function getByWhereInIds($ids)
    {
        return $this->model
            ->whereIn('id', $ids)
            ->get();
    }

    public function getById($id)
    {
        return $this->model
            ->where('id', $id)
            ->first();
    }

    public function getByWhere($where)
    {
        return $this->model
            ->where($where)
            ->get();
    }

    public function countByWhere($where)
    {
        return $this->model
            ->where($where)
            ->count();
    }

    public function checkByWhere($where)
    {
        return $this->model
            ->where($where)
            ->exists();
    }

    public function insertNewRecord($array)
    {
        return $this->model
            ->create($array);
    }

    public function updateById($array, $id)
    {
        return $this->model
            ->where('id', $id)
            ->update($array);
    }

    public function updateFieldsByWhere($where, $field)
    {
        return $this->model
            ->where($where)
            ->update($field);
    }

    public function deleteById($id)
    {
        return $this->model
            ->find($id)
            ->delete();
    }

    public function deleteByWhere($where)
    {
        return $this->model
            ->where($where)
            ->delete();
    }

    public function updateOrInsert($where, $update)
    {
        return $this->model->updateOrCreate($where, $update);
    }

    public function getByWhereFirst($where)
    {
        return $this->model->where($where)->first();
    }


    public function getQuestionAndAnswers($quizId)
    {
        return $this->model
            ->where('quize_id','=',$quizId)
            ->with('answer:id,question_id,answer')
            ->select('id', 'question')
            ->get();

    }
}
?>
