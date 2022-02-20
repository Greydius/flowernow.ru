<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ArticleCategory;

class ArticleCategoryController extends Controller
{
        public function index()
        {
                //
                $articleCategories = ArticleCategory::get();
                return view('admin.article_categories.list', [
                        'articleCategories' => $articleCategories
                ]);
        }

        public function create()
        {
                //
                return view('admin.article_categories.create', []);
        }

        public function store(Request $request)
        {

                $articleCategory = new ArticleCategory();
                $articleCategory->name = $request->name;
                $articleCategory->save();

                return redirect()->route('admin.article-categories');
        }

        public function edit($id)
        {
                //
                $articleCategory = ArticleCategory::findOrFail($id);
                return view('admin.article_categories.create', [
                        'articleCategory' => $articleCategory
                ]);
        }

        public function update(Request $request, $id)
        {
                //
                $articleCategory = ArticleCategory::findOrFail($id);

                $articleCategory->name = $request->name;
                $articleCategory->save();

                return redirect()->route('admin.article-categories');
        }

        public function destroy($id)
        {
                //
                $articleCategory = ArticleCategory::findOrFail($id);
                if($articleCategory->delete()) {
                        \App\Model\Article::where('article_category_id', $id)->update(['article_category_id' => null]);
                }
                return redirect()->route('admin.article-categories');
        }
}