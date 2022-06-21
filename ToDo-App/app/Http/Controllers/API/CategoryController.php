<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Category;
use Validator;
use Auth;

class CategoryController extends BaseController
{

    /**
     * store category to our application
     */
    public function get($user_id)
    {
        return Category::orderBy('id','desc')->where('user_id',$user_id)->get();
    }
    /**
     * store category to our application
     */
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'user_id' => 'required',
            'name' => 'required',
            'status' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();
        $category = Category::create($input);
        $success['categories'] =  Category::orderBy('id','desc')->where('user_id',$request->user_id)->get();
   
        return $this->sendResponse($success, 'Category created successfully.');
    }

    // get individual category by id
    public function get_category_by_id($id)
    {
        $success['category'] =  Category::findOrFail($id);
   
        return $this->sendResponse($success, 'Category get successfully successfully.');
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'name' => 'required',
            'status' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();
        $category = Category::findOrFail($id)->update($input);
        $success['categories'] =  Category::orderBy('id','desc')->where('user_id',$request->user_id)->get();
   
        return $this->sendResponse($success, 'Category updated successfully.');
    }
}
