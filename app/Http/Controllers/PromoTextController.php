<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\PromoText;
use App\Model\Flower;

class PromoTextController extends Controller
{
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
                //
                $articles = PromoText::get();
                return view('admin.promo_texts.list', [
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
                return view('admin.promo_texts.create', [
                        'flowers' => Flower::where('popularity', '>', 0)->orderBy('popularity', 'desc')->get()
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
                $detail = $request->text;


                $new_details = $detail;


                $article = new PromoText();
                $article->flower_id = $request->flower_id;
                $article->type = $request->type;
                $article->text = $new_details;
                $article->save();

                return redirect()->route('admin.promo_texts');
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
                $article = PromoText::findOrFail($id);
                return view('admin.promo_texts.create', [
                        'article' => $article,
                        'flowers' => Flower::where('popularity', '>', 0)->orderBy('popularity', 'desc')->get()
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
                $article = PromoText::findOrFail($id);

                $detail = $request->text;
/*
                $dom = new \domdocument();
                $dom->loadHtml('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">'.$detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

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
*/
                $new_details = $detail;
                $article->flower_id = $request->flower_id;
                $article->type = $request->type;
                $article->text = $new_details;
                $article->save();

                return redirect()->route('admin.promo_texts');
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
                $article = PromoText::findOrFail($id);
                $article->delete();
                return redirect()->route('admin.promo_texts');
        }
}
