<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Article;
use App\Model\ArticleCategory;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
            $articles = Article::with(['category'])->get();
            return view('admin.article.list', [
                    'articles' => $articles
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
            return view('admin.article.create', [
                    'categories' => ArticleCategory::get()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
            $detail = $request->article;

            $dom = new \domdocument();
            //$dom->loadHtml('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">'.$detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            //echo mb_convert_encoding($detail, 'HTML-ENTITIES', 'UTF-8'); exit();
            $dom->loadHTML(mb_convert_encoding($detail, 'HTML-ENTITIES', 'UTF-8'));

            $images = $dom->getelementsbytagname('img');

            if(!empty($images)) {
                    foreach ($images as $k => $img) {
                            $data = $img->getattribute('src');

                            if(strpos($data, ';') !== false) {
                                    list($type, $data) = explode(';', $data);
                                    list(, $data) = explode(',', $data);

                                    $data = base64_decode($data);
                                    $image_name = time() . $k . '.png';
                                    $path = public_path() . '/articles/images/' . $image_name;

                                    file_put_contents($path, $data);

                                    $img->removeattribute('src');
                                    $img->setattribute('src', '/articles/images/' . $image_name);
                            }
                    }
            }


            $detail = $dom->savehtml();



            $new_details = '';

            $d = new \DOMDocument;
            $d->loadHTML($detail);

            $body = $d->getElementsByTagName('body')->item(0);
            // perform innerhtml on $body by enumerating child nodes
            // and saving them individually
            foreach ($body->childNodes as $childNode) {
                    $new_details .= $d->saveHTML($childNode);
            }

            $article = new Article();
            $article->name = $request->name;
            $article->slug = $request->slug;
            $article->public = (int)$request->public;
            $article->article_category_id = $request->article_category_id;
            $article->article = $new_details;
            $article->save();

            return redirect()->route('admin.articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //

            $productTypes = \App\Model\ProductType::where('show_on_main', '1')->get();
            $city_id = $this->current_city->id;

            $request = new Request();
            $request->order = 'rand';
            $popularProducts = \App\Model\Product::popular($this->current_city->id, $request, 1, 8);

            $article = Article::where('slug', $slug)->where('public', 1)->firstOrFail();
            $articles = [];
            $nextArticle = null;

            if(!empty($article->article_category_id)) {
                    $articles = Article::where('article_category_id', $article->article_category_id)->where('public', 1)->get();
                    $nextArticle = Article::where('article_category_id', $article->article_category_id)->where('public', 1)->where('id', '>', $article->id)->first();
            }

            return view('front.article.show', [
                    'pageTitle' => $article->name,
                    'article' => $article,
                    'articles' => $articles,
                    'nextArticle' => $nextArticle,
                    'popularProducts' => $popularProducts
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
            $article = Article::findOrFail($id);
            return view('admin.article.create', [
                    'article' => $article,
                    'categories' => ArticleCategory::get()
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
            $article = Article::findOrFail($id);

            $detail = $request->article;

            $dom = new \domdocument();
            //$dom->loadHtml('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">'.$detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            //$dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom->loadHTML(mb_convert_encoding($detail, 'HTML-ENTITIES', 'UTF-8'));

            $images = $dom->getelementsbytagname('img');

            foreach ($images as $k => $img) {
                    $data = $img->getattribute('src');

                    if(strpos($data, ';') !== false) {
                            list($type, $data) = explode(';', $data);
                            list(, $data) = explode(',', $data);

                            $data = base64_decode($data);
                            $image_name = time() . $k . '.png';
                            $path = public_path() . '/articles/images/' . $image_name;

                            file_put_contents($path, $data);

                            $img->removeattribute('src');
                            $img->setattribute('src', '/articles/images/' . $image_name);
                    }
            }

            $detail = $dom->savehtml();


            $new_details = '';

            $d = new \DOMDocument;
            $d->loadHTML($detail);
            $body = $d->getElementsByTagName('body')->item(0);
            // perform innerhtml on $body by enumerating child nodes
            // and saving them individually
            foreach ($body->childNodes as $childNode) {
                    $new_details .= $d->saveHTML($childNode);
            }

            $article->name = $request->name;
            $article->slug = $request->slug;
            $article->public = (int)$request->public;
            $article->article_category_id = $request->article_category_id;
            $article->article = $new_details;
            $article->save();

            return redirect()->route('admin.articles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
            $article = Article::findOrFail($id);
            $article->delete();
            return redirect()->route('admin.articles');
    }
}
