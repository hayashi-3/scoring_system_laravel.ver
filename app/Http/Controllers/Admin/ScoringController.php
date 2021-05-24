<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Questions;
use App\CorrectAnswers;
use App\Histories;

class ScoringController extends Controller
{

    private $formItems = ["ids", "answer_ids", "answers"];

    public function test()
    {
        $questions = Questions::inRandomOrder()->get();
        return view('admin.scoring.list', compact('questions'));
    }

    public function scoring(Request $request)
    {
        $inputs = $request->only($this->formItems);

        $question_ids = $inputs['ids'];
        $answer_ids = $inputs['answer_ids'];
        $answers = $inputs['answers'];

        // [$question_id => $inputs['answers']]
        $input_answers = [];
        foreach ($answers as $answer){
          foreach ($question_ids as $question_id){
            if (!isset($input_answers[$question_id])) {
                $input_answers[$question_id] = $answer;
              break;
            }
          }
        }

        // [questions_id:1, answer:hoge]
        foreach ($question_ids as $question_id){
            $db_q_ids[] = Questions::find($question_id)->correctAnswers()->get(['questions_id','answer'])->all();
        }

        $db_q_ids = array_flip($db_q_ids);
        dd($db_q_ids);

         // ここからはまだ書いてない
        $db_ans = [];
        for ($i = 0; $i < count($db_q_answers); $i++) {
            $db_q_ans = $db_q_answers[$i];
            for ($j = 0; $j < $i; $j++){
                $db_q_id = $db_q_ids[$j];
                for ($k = 0; $k < count($db_q_id); $k++){
                    $db_id = $db_q_id[$k];
                    $db_ans[$db_id] = $db_q_ans;
                }
            }
        }
        dd($db_ans);

        $score = 0;

        // [$question_id => $inputs['answers']]と[$db_question_id => $db_answer]
        foreach ($tmp as $input_answer) {
            $db_answers = CorrectAnswers::find($answer_id);
            for($j=0; $j < count($answers); $j++){
                $input_answer = $answers[$j];
                if($db_answer == $input_answer){
                    $score++;
                    break;
                }
            }
        }
        dd($score);

        // 問題数カウント
        $q_count = count($question_ids);

        // 得点
        $result = round(100 * $score / $q_count);

        // 採点履歴へ登録処理
        $user_id = Auth::id();
        $user = Auth::user();

        \DB::beginTransaction();
            try {
                $history = new Histories();
                $history->user_id = $user_id;
                $history->point = $result;
                $history->created_at = Carbon::now();
                // modelにて$timestampsをfalseにしている
                $history->save();

        \DB::commit();

        } catch(\Throwable $e) {
            \DB::rollback();
            abort(500);
        }

        return view('admin.scoring.result', compact('user', 'q_count', 'result', 'score'));
    }
}
