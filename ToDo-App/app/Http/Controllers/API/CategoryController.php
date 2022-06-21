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
    public function get()
    {
        return Category::orderBy('id','desc')->get();
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
        $success['categories'] =  Category::orderBy('id','desc')->get();
   
        return $this->sendResponse($success, 'Category created successfully.');
    }
}
