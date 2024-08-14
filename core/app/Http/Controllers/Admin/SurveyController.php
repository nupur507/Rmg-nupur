<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Survey;
use App\Models\Question;
use App\Rules\FileTypeValidate;

class SurveyController extends Controller{

    public function allCategory(){
        $page_title = 'Survey Categories';
        $empty_message = 'No category found';
        $categories = Category::latest()->paginate(getPaginate());
        return view('admin.survey.category', compact('page_title', 'empty_message', 'categories'));
    }

    public function addCategory(Request $request){

        $request->validate([
            'name' => 'required|string|max:255|unique:categories'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->status = $request->status ? 1 : 0;
        $category->save();

        $notify[] = ['success', 'Survey category added successfully'];
        return back()->withNotify($notify);
    }

    public function updateCategory(Request $request){

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,'.$request->id,
        ]);

        $category = Category::findOrFail($request->id);
        $category->name = $request->name;
        $category->status = $request->status ? 1 : 0;
        $category->save();

        $notify[] = ['success', 'Survey category updated successfully'];
        return back()->withNotify($notify);
    }

    public function allSurvey(){
        $page_title = 'All Survey';
        $all_survey = Survey::latest()->paginate(getPaginate());
        $empty_message = 'No survey found';
        return view('admin.survey.index', compact('page_title','all_survey','empty_message'));
    }

    public function newSurvey(){
        $page_title = 'New Survey';
        $categories = Category::where('status', 1)->latest()->get();
        return view('admin.survey.new', compact('page_title', 'categories'));
    }

    public function addSurvey(Request $request){

        $request->validate([
            'image' => ['required',new FileTypeValidate(['jpeg', 'jpg', 'png'])],
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255',
        ]);

        $survey = new Survey();
        $survey->name = $request->name;
        $survey->category_id = $request->category_id;
        $survey->status = $request->status ? 1 : 0;

        if($request->hasFile('image')){
            try{
                $location = imagePath()['survey']['path'];
                $size = imagePath()['survey']['size'];
                $survey->image = uploadImage($request->image, $location , $size);
            }catch(\Exception $exp) {
                return back()->withNotify(['error', 'Could not upload the image.']);
            }
        }

        $survey->save();

        $notify[] = ['success', 'Survey added successfully'];
        return redirect()->route('admin.survey.new.question', $survey->id)->withNotify($notify);
    }

    public function editSurvey($id){
        $survey = Survey::findOrFail($id);
        $page_title = 'Edit Survey';
        $categories = Category::where('status', 1)->latest()->get();
        return view('admin.survey.edit',compact('page_title', 'survey', 'categories'));
    }

    public function updateSurvey(Request $request){

        $request->validate([
            'image' => [new FileTypeValidate(['jpeg', 'jpg', 'png'])],
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255',
        ]);

        $survey = Survey::find($request->id);

        $survey->name = $request->name;
        $survey->category_id = $request->category_id;
        $survey->status = $request->status ? 1 : 0;

        if($request->hasFile('image')){
            try{
                $location = imagePath()['survey']['path'];
                $size = imagePath()['survey']['size'];
                $survey->image = uploadImage($request->image, $location , $size, $survey->image);
            }catch(\Exception $exp) {
                return back()->withNotify(['error', 'Could not upload the image.']);
            }
        }

        $survey->save();

        $notify[] = ['success', 'Survey information updated successfully'];
        return back()->withNotify($notify);
    }

    public function newQuestion($id){
        $survey = Survey::findOrFail($id);
        $page_title = 'Add Question for '.$survey->name;
        return view('admin.question.new', compact('page_title','survey'));
    }

    public function allQuestion($id){
        $survey = Survey::findOrFail($id);
        $page_title = 'All Questions of '.$survey->name;
        $questions = $survey->questions()->paginate(getPaginate());
        $empty_message = 'No question found';
        return view('admin.question.index', compact('page_title', 'survey', 'empty_message', 'questions'));
    }

    public function addQuestion(Request $request){

        $request->validate([
            'id' => 'required|exists:surveys,id',
            'type' => 'required|in:1,2',
            'custom_input' => 'required|in:0,1',
            'custom_input_type' => 'sometimes|in:0,1',
            'custom_question' => 'sometimes|max:255',
            'question' => 'required|max:255',
            'options.*' => 'required|max:255',
        ],[
            'options.*.required' => 'Please add all options',
            'options.*.max' => 'Total options should not be more than 255 characters'
        ]);

        $survey = Survey::find($request->id);

        $question = new Question();
        $question->survey_id = $survey->id;
        $question->question = $request->question;
        $question->type = $request->type;
        $question->custom_input = $request->custom_input;
        $question->custom_input_type = $request->custom_input_type ?? 0;
        $question->custom_question = $request->custom_question;
        $question->options = $request->options;
        $question->save();

        $notify[] = ['success', 'Question added successfully'];
        return redirect()->route('admin.survey.all.question', $survey->id)->withNotify($notify);
    }

    public function editQuestion($question_id, $survey_id){
        $question = Question::where('id', $question_id)->where('survey_id', $survey_id)->firstOrFail();
        $page_title = 'Edit Question';
        return view('admin.question.edit',compact('page_title','question'));
    }

    public function updateQuestion(Request $request){

        $request->validate([
            'survey_id' => 'required|exists:surveys,id',
            'id' => 'required|exists:questions,id',
            'type' => 'required|in:1,2',
            'custom_input' => 'required|in:0,1',
            'custom_input_type' => 'sometimes|in:0,1',
            'custom_question' => 'sometimes|max:255',
            'question' => 'required|max:255',
            'options.*' => 'required|max:255',
        ],[
            'options.*.required' => 'Please add all options',
            'options.*.max' => 'Total options should not be more than 255 characters'
        ]);

        $question = Question::where('id', $request->id)->where('survey_id', $request->survey_id)->firstOrFail();

        if(!$request->options){
            $options = $question->options;
        }

        if($request->options){
            $options = array_merge( $question->options, $request->options);
        }

        $question->question = $request->question;
        $question->type = $request->type;
        $question->custom_input = $request->custom_input;
        $question->custom_input_type = $request->custom_input_type ?? 0;
        $question->custom_question = $request->custom_question;
        $question->options = $options;
        $question->save();

        $notify[] = ['success', 'Question updated successfully'];
        return back()->withNotify($notify);
    }

    public function report(){
        $page_title = 'Survey Report';
        $empty_message = 'No survey report found';
        $all_survey = Survey::where('users', '!=', null)->whereHas('questions')->orderBy('last_report', 'DESC')->paginate(getPaginate());
        return view('admin.survey.report', compact('page_title','all_survey','empty_message'));
    }

    public function reportQuestion($id){
        $page_title = 'Survey Report';
        $survey = Survey::findOrFail($id);

        if(count($survey->answers) <= 0){
            $notify[] = ['error', 'Not report ready yet'];
            return back()->withNotify($notify);
        }
        return view('admin.survey.report_question', compact('page_title', 'survey'));
    }

    public function reportDownload($id){
        $survey = Survey::findOrFail($id);

        if(count($survey->questions) <= 0) {
            $notify[] = ['error', 'No report available'];
            return back()->withNotify($notify);
        }

        $page_title = 'Report Download';
        $filename = strtolower(str_replace(' ','_',$survey->name));
        return view('admin.survey.report_download',compact('survey','page_title','filename'));
    }

}


