<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use Validator;

class RatingController extends Controller
{

    public function rateRecipe(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|min:1|between: 1,5'
        ]);

        if($validator->fails()) {
            
            return response()->json(['errors'=>$validator->errors()]);

        }

        Rating::create([
            'recipe_id' => $id,
            'rating' => $request->rating
        ]);

        return response()->json([
            'message' => 'Your rating has been added successfully',
        ]);

    }

}
