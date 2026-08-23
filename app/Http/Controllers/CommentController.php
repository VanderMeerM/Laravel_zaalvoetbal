<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Date; 
use App\Models\Comment;

class CommentController extends Controller
{
     public function store($id) {

    $id = Date::find($id);
    
    Comment::create([
      'date' => now(), 
      'description' => request()->description,
      'user_id' => request()->user_id,
      'date_id' => $id->id
      
    ]);

      return to_route('dates.show', [
      'date' => $id->id
      ]); 

    }
}
