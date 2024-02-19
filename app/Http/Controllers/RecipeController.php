<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Rating;

use Validator;

class RecipeController extends Controller
{

    //Create a new recipe

    public function create(Request $request){

        $validator = Validator::make($request->all(), [
                        'name' => 'required|string',
                        'prep_time'=>'required|string',
                        'difficulty'=>'required|integer|min:1|between: 1,3',
                        'veg' => 'required|boolean'
                    ]);


        
        if($validator->fails()) {
            
            return response()->json(['errors'=>$validator->errors()]);

        }

        Recipe::create([

            'name' => $request->name,
            'prep_time' => $request->prep_time,
            'difficulty' => $request->difficulty,
            'veg' => $request->veg

        ]);

        return response()->json([
            'message' => 'Recipe has been added successfully',
        ]);
        
    }


    //Update an Existing Recipe

    public function update(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'prep_time'=>'required|string',
            'difficulty'=>'required|integer|min:1|between: 1,3',
            'veg' => 'required|boolean'
        ]);

        if($validator->fails()) {
            
            return response()->json(['errors'=>$validator->errors()]);

        }


        $recipe = Recipe::where('id',$id)->first();

        $recipe->name = $request->name;
        $recipe->prep_time = $request->prep_time;
        $recipe->difficulty = $request->difficulty;
        $recipe->veg = $request->veg;
        $recipe->save();

        return response()->json([
            'message' => 'Recipe has been updated successfully',
        ]);

    }


    //Delete recipe

    public function delete($id){

        Recipe::where('id',$id)->delete();

        return response()->json([
            'message' => 'Recipe has been deleted successfully',
        ]);

    }


    //Get details of one recipe

    public function getRecipe($id){

        $recipe = Recipe::where('id',$id)->first();

        $rating = Rating::where('recipe_id',$id)->get()->avg('rating');

        $recipe->rating = $rating;

        if( !$recipe ){
            return response()->json([
                'message' => 'Recipe not found',
            ]);
        }


        return response()->json([
            'result' => $recipe,
        ]);

    }

    // List Recipes

    public function listRecipe(){

        $recipes = Recipe::paginate(10);


        return response()->json([
            'result' => $recipes,
        ]);

    }




}
