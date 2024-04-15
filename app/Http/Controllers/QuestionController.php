<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    private $limit;
    public function __construct()
    {
        $this->middleware('auth');
        $this->limit = 20;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::paginate($this->limit);
        return view('question.index')->with('questions', $questions);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['categories'] =  Category::all();
        return view('question.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'cat_id' => 'required',
            'name' => 'required|unique:questions,cat_id',
            'option1' => 'required',
            'option2' => 'required',
            'answer' => 'required',
            'status' => 'required'
        ]);
        $data = array(
            'cat_id' => $request->cat_id,
            'name' => $request->name,
            'option1' => $request->option1,
            'option2' => $request->option2,
            'answer' => $request->answer,
            'status' => $request->status
        );
        Question::create($data);
        return redirect()->route('category-management.index', ['cat_id' => $request->cat_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $question = Question::find($id);
        return view('question.show')->with('question', $question);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['question'] = Question::find($id);
        return view('question.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $question = Question::find($id);
        if (empty($question)) {
            return redirect()->route('question.index');
        }

        $this->validate($request, [
            'cat_id' => 'required',
            'name' => 'required|max:300',
            'option1' => 'required',
            'option2' => 'required',
            'answer' => 'required',
            'status' => 'required'
        ]);

        $active_status = Question::where(array('cat_id' => $question->cat_id, 'status' => 'active'))->count();
        if($active_status < 11 && $request->status === 'inactive') {
            return back()->with('error', "You can't Inactive less than 10 questions.");
        }

        $question->name = $request->name;
        $question->option1 = $request->option1;
        $question->option2 = $request->option2;
        $question->answer = $request->answer;
        $question->status = $request->status;
        $question->save();
        return redirect()->route('category-management.index', ['cat_id' => $request->cat_id]);
    }

    public function ajax_question_update(Request $request)
    {
        $question = Question::find($request->question_id);
        $active_status = Question::where(array('cat_id' => $question->cat_id, 'status' => 'active'))->count();
        $response = array(
            'header' => array(
                'code' => 403,
                'status' => 'error',
                'message' => "You can't Inactive less than 10 questions."
            ),
            'body' => null
        );
        if($active_status < 11 && $request->status === 'inactive') {
            return response()->json($response, 403);
        }
        $question->status = $request->status;
        $question->save();
        $response['header']['code'] = 200;
        $response['header']['status'] = 'success';
        $response['header']['message'] = 'Question status changed to ' . Str::title($request->status);
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $question = Question::find($id);
        $question->delete();
        return redirect()->route('category-management.index');
    }
}
