<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Questions;
use App\CorrectAnswers;
use App\Histories;

class ScoringController extends Controller
{
    public function test()
    {
        $questions = Questions::inRandomOrder()->get();
        return view('admin.scoring.list', compact('questions'));
    }

    public function scoring(Request $request)
    {
        // データを受け取る
        $inputs = $request->all();
        $question_ids = $inputs['ids'];

        $score = 0;
        
        // dbにある正解を取ってきてinputと比較する
        foreach ($question_ids as $q_id) {
            $question = Questions::find($q_id);

           foreach($question->correctAnswers as $db_answers){
               $db_answer = $db_answers->answer;
                foreach($inputs['answers'] as $input_answer){
                    if($db_answer === $input_answer){
                        ++$score;
                        break;
                    }
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
