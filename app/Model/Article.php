<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\MainModel;

class Article extends MainModel
{
    //

        // relation for category
        function category() {
                return $this->belongsTo('App\Model\ArticleCategory', 'article_category_id');
        }
}
