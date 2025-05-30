<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
  // Validation rules
  protected function articleValidationRules()
  {
    return [
      'image' => 'required|url',
      'title' => 'required|string|max:255',
      'link' => 'required|url',
      'date' => 'required|date',
      'content' => 'required|string',
      'status' => 'required|in:For Edit,Published',
      'writer_id' => 'required|exists:users,id',
      'editor_id' => 'required|exists:users,id',
      'company_id' => 'required|exists:companies,id',
    ];
  }

  // Retrieve all articles
  public function index()
  {
    return Article::with([
      'writer:id,firstname,lastname', // Include firstname and lastname for writer
      'editor:id,firstname,lastname', // Include firstname and lastname for editor
      'company:id,name' // Assuming 'name' is the field you want from the Company model
    ])->get()->map(function ($article) {
      $article->writer_full_name = "{$article->writer->firstname} {$article->writer->lastname}";
      $article->editor_full_name = "{$article->editor->firstname} {$article->writer->lastname}";
      return $article;
    });
  }


  // Store a new article
  public function store(Request $request)
  {
    // Define validation rules
    $rules = $this->articleValidationRules();

    // Validate the request using the Validator facade
    $validator = Validator::make($request->all(), $rules);

    // Check if validation fails
    if ($validator->fails()) {
      return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    $article = Article::create($request->all());

    return response()->json($article, Response::HTTP_CREATED);
  }

  // Retrieve a single article
  public function show($id)
  {
    $article = Article::with([
      'writer:id,firstname,lastname', // Include firstname and lastname for writer
      'editor:id,firstname,lastname', // Include firstname and lastname for editor
      'company:id,name' // Assuming 'name' is the field you want from the Company model
    ])->find($id);

    if (!$article) {
      return response()->json(['message' => 'Article not found'], Response::HTTP_NOT_FOUND);
    }

    // Add full names to the article object
    $article->writer_full_name = "{$article->writer->firstname} {$article->writer->lastname}";
    $article->editor_full_name = "{$article->editor->firstname} {$article->editor->lastname}";

    return response()->json($article);
  }

  // Update an existing article
  public function update(Request $request, $id)
  {

    $article = Article::find($id);

    // Define validation rules
    $rules = $this->articleValidationRules(true);

    // Validate the request
    $validator = Validator::make($request->all(), $rules);

    // Check if validation fails
    if ($validator->fails()) {
      return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    $article->update($request->all());

    return response()->json($article);
  }

  // Delete an article
  public function destroy($id)
  {
    $article = Article::find($id);

    if (!$article) {
      return response()->json(['message' => 'Article not found'], Response::HTTP_NOT_FOUND);
    }

    $article->delete();

    return response()->json(['message' => 'Article deleted successfully'], Response::HTTP_NO_CONTENT);
  }
}
