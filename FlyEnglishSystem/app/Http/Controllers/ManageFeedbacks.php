<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManageFeedback;
use App\Models\Student;
use App\Models\Book;
use App\Models\TypeOfFeedback;
use DB;

class ManageFeedbacks extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $pick_s = DB::table('students') 
                        ->join('manage_feedback','manage_feedback.student_id', '=' , 'students.id')
                        ->get();

        $pick_b = DB::table('books') 
                        ->join('manage_feedback','manage_feedback.book_id', '=' , 'books.id')
                        ->get();

        $pick_gf = DB::table('type_of_feedback') 
                        ->join('manage_feedback','manage_feedback.good_feedback_id', '=' , 'type_of_feedback.id')
                        ->where('status', '=' , 1)
                        ->get();

        $pick_if = DB::table('type_of_feedback') 
                        ->join('manage_feedback','manage_feedback.improve_feedback_id', '=' , 'type_of_feedback.id')
                        ->where('status', '=' , 2)
                        ->get();

        $pick_mf = DB::table('manage_feedback')->get();


        $manage_feedbacks = ManageFeedback::all();
        $manage_students = Student::all();
        $manage_books = Book::all();
        $manage_tof = TypeOfFeedback::all();
        
        return view('ManageFeedbacks.Manage_Feedbacks',
            compact('pick_s','pick_b','pick_gf','pick_if','pick_mf',
                    'manage_feedbacks','manage_students','manage_books','manage_tof'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $manage_feedbacks = new ManageFeedback;

        $manage_feedbacks->student_id = $request->input('student_id');
        $manage_feedbacks->book_id = $request->input('book_id');
        $manage_feedbacks->good_feedback_id = $request->input('good_feedback');
        $manage_feedbacks->improve_feedback_id = $request->input('improve_feedback');
        $manage_feedbacks->mispronounce = $request->input('mispronounce');
        $manage_feedbacks->incorrect = $request->input('incorrect');
        $manage_feedbacks->check_homework = $request->input('check_homework');
        $manage_feedbacks->topic = $request->input('topic');
        $manage_feedbacks->homework = $request->input('homework');

        $manage_feedbacks->save();

        return redirect()->back()->with('success','Feedback set successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $manage_feedbacks = ManageFeedback::find($id);

        return response()->json([   'id'=>$manage_feedbacks->id,
                                    'student_id'=>$manage_feedbacks->student_id,
                                    'book_id'=>$manage_feedbacks->book_id,
                                    'good_feedback_id'=>$manage_feedbacks->good_feedback,
                                    'improve_feedback_id'=>$manage_feedbacks->improve_feedback,
                                    'mispronounce'=>$manage_feedbacks->mispronounce,
                                    'incorrect'=>$manage_feedbacks->incorrect,
                                    'check_homework'=>$manage_feedbacks->check_homework,
                                    'topic'=>$manage_feedbacks->topic,
                                    'homework'=>$manage_feedbacks->homework
                                ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->input('update_id');

        $manage_feedbacks = ManageFeedback::find($id);

        $manage_feedbacks->student_id = $request->input('u_student_id');
        $manage_feedbacks->book_id = $request->input('u_book_id');
        $manage_feedbacks->good_feedback_id = $request->input('u_good_feedback');
        $manage_feedbacks->improve_feedback_id = $request->input('u_improve_feedback');
        $manage_feedbacks->mispronounce = $request->input('u_mispronounce');
        $manage_feedbacks->incorrect = $request->input('u_incorrect');
        $manage_feedbacks->check_homework = $request->input('u_check_homework');
        $manage_feedbacks->topic = $request->input('u_topic');
        $manage_feedbacks->homework = $request->input('u_homework');

        $manage_feedbacks->update();

        return redirect()->back()->with('success','Successfully updated!');

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