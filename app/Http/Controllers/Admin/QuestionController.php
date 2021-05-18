<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Questions;
use App\CorrectAnswers;

class QuestionController extends Controller
{

    private $formItems = ["question", "answers"];

	private $validator = [
		'question' => 'required|string|max:500',
		'answer.*' => 'required|string|max:200',
	];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $questions = Questions::all();
        $answers = CorrectAnswers::all();
        return view('admin.question.list', compact('questions', 'answers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('admin.question.register');
    }

    function post(Request $request){
        $input = $request->only($this->formItems);

        $validator = Validator::make($input, $this->validator);
		if($validator->fails()){
			return redirect()->action("Admin\QuestionController@register")
				->withInput()
				->withErrors($validator);
		}

        //セッションに書き込む
		$request->session()->put("form_input", $input);

		return redirect()->action("Admin\QuestionController@registerConfirm");
    }

    /**
     * Show the form for confirm creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registerConfirm(Request $request)
    {
        //セッションから値を取り出す
        $input = $request->session()->get("form_input");
        
        //セッションに値が無い時はフォームに戻る
        if(!$input){
            return redirect()->action("QuestionController@register");
        }
        return view("admin.question.registerConfirm",["input" => $input]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // データを受け取る
        $input = $request->only($this->formItems);

        \DB::beginTransaction();
        try {

            $question = new Questions();

            $model = $question->create([
                'question' => $input['question'],
            ]);

            foreach($input['answers'] as $answer){
                $model->correctAnswers()->create([
                    'answer' => $answer,
                ]);
            }
            
            \DB::commit();

        } catch(\Throwable $e) {
            \DB::rollback();
            abort(500);
        }

        // \Session::flash('err_msg', '登録しました。');
        return redirect(route('list'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
