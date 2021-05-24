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

    private $formItems = ["ids", "db_answers", "answers"];

    public function test()
    {
        $questions = Questions::inRandomOrder()->get();
        return view('admin.scoring.list', compact('questions'));
    }

    public function scoring(Request $request)
    {
        $inputs = $request->only($this->formItems);
        $question_ids = $inputs['ids'];
        $answers = $inputs['answers'];
        $db_answers = $inputs['db_answers'];

        $score = 0;
        foreach($answers as $answer){
            foreach($db_answers as $db_answer){
                if($answer === $db_answer){
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
