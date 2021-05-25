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

    private $formItems = ["ids", "answers"];

    public function test()
    {
        $questions = Questions::inRandomOrder()->get();
        return view('admin.scoring.list', compact('questions'));
    }

    public function scoring(Request $request)
    {
        $inputs = $request->only($this->formItems);

        $question_ids = $inputs['ids'];
        $input_answers = $inputs['answers'];

        // [$question_id => $inputs['answers']]
        $arr_input_answers[] = array_combine($question_ids, $input_answers);

        // [answer => hoge, questions_id => fuga]
        foreach ($question_ids as $question_id){
            $db_answers[] = Questions::find($question_id)
                ->correctAnswers()->where('questions_id', $question_id)
                ->get(['questions_id','answer'])->all();
        }

        // [$question_id => dbのanswer]
        foreach ($db_answers as $db_answer){
            foreach ($db_answer as $db_ans){
                $questions_id = $db_ans['questions_id'];
                $answer = $db_ans['answer'];
                $db_a[] = ["questions_id" => $questions_id, "answer" => $answer];
            }
        }

        $score = 0;

        // [$question_id => $inputs['answers']]と[$question_id => dbのanswer]
        foreach ($db_a as $a) {
            for ($j = 0; $j < count($arr_input_answers); $j++) {
                $arr_inp_ans = $arr_input_answers[$j];
                $input_answer = $arr_inp_ans[$a["questions_id"]];
                if($a["answer"] === $input_answer){
                    $score++;
                    break;
                }
            }
        }

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
