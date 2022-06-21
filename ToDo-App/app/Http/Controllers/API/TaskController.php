<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Category;
use App\Models\Task;
use Validator;
use Auth;

class TaskController extends BaseController
{
    //get category function
    public function get_category($user_id)
    {
    	return Category::where('user_id',$user_id)->where('status',1)->get();
    }

    public function get($user_id)
    {
        return Task::where('user_id',$user_id)->orderBy('is_pinned','desc')->orderBy('id','desc')->get();
    }

    // task store function
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'user_id' => 'required',
    		'category_id' => 'required',
            'title' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();
        $task = Task::create($input);
        $success['tasks'] =  Task::orderBy('is_pinned','desc')->orderBy('id','desc')->where('user_id',$request->user_id)->get();
   
        return $this->sendResponse($success, 'Task created successfully.');
    }

    // get individual task by id
    public function get_task_by_id($id)
    {
        $success['task'] =  Task::findOrFail($id);
        $success['category_name'] =  Category::where('id',$success['task']->category_id)->value('name');
   
        return $this->sendResponse($success, 'Task get successfully successfully.');
    }

    // update task
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
    		'user_id' => 'required',
    		'category_id' => 'required',
            'title' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $input = $request->all();

        if (!$request->has('is_pinned')) {
        	$input['is_pinned'] = 0;
        }

        if (!$request->has('is_important')) {
        	$input['is_important'] = 0;
        }
   
        $task = Task::findOrFail($id)->update($input);
        $success['tasks'] =  Task::orderBy('is_pinned','desc')->orderBy('id','desc')->where('user_id',$request->user_id)->get();
   
        return $this->sendResponse($success, 'Task updated successfully.');
    }

    // complete task function
    public function complete($id, $user_id)
    {
    	$task = Task::where('id',$id)->where('user_id',$user_id)->update(['is_completed'=>1]);
        $success['tasks'] =  Task::orderBy('is_pinned','desc')->orderBy('id','desc')->where('user_id',$user_id)->get();
   
        return $this->sendResponse($success, 'Task completed successfully.');
    }

    //get pinned tasks 
    public function pinned_tasks($user_id)
    {
    	return Task::where('user_id',$user_id)->where('is_pinned',1)->orderBy('id','desc')->get();
    }

    //get important tasks 
    public function important_tasks($user_id)
    {
    	return Task::where('user_id',$user_id)->where('is_important',1)->orderBy('id','desc')->get();
    }
}
