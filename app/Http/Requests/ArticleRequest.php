<?php

namespace App\Http\Requests;

use App\Http\Controllers\Dashboard\Blog\ArticlesController;
use App\Models\Dashboard\Blog\Articles;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class ArticleRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Articles $articles, ArticlesController $articlesController)
    {
        $rules = [
            'title' => 'required|max:255',
            'image' => 'required|max:8192|mimes:jpg,png,jpeg,webp',
            'content' => 'required',
            // SEO
            'slug' => 'required|max:255|unique:' . $articles->table,
            ///    'meta_title'         => 'required|max:60',
            'meta_description' => 'required|max:150',
            // Sub Category
            'category' => 'nullable|in:' . inValidate(DB::table('categories')->get(['id'])->toArray()),
            'type' => 'required|in:' . implode(',', $articlesController->typeOfArticles),
        ];

        if ($this->method() == 'PATCH') { // On Update
            $rules['image'] = 'nullable|max:8192|mimes:jpg,png,jpeg,webp';
            $rules['slug'] = 'required|max:255|unique:' . $articles->table . ',slug,' . $this->id;
        }

        return $rules;
    }
}
