@extends('layouts.site')

@php
$langs = [
    "en" => "English",
    "ar" => "Arabic",
    "bg" => "Bulgarian",
    "zh-CN" => "Chinese (Simplified)",
    "zh-TW" => "Chinese (Traditional)",
    "hr" => "Croatian",
    "cs" => "Czech",
    "da" => "Danish",
    "nl" => "Dutch",
    "fi" => "Finnish",
    "fr" => "French",
    "de" => "German",
    "el" => "Greek",
    "hi" => "Hindi",
    "it" => "Italian",
    "ja" => "Japanese",
    "ko" => "Korean",
    "no" => "Norwegian",
    "pl" => "Polish",
    "pt" => "Portuguese",
    "ro" => "Romanian",
    "ru" => "Russian",
    "es" => "Spanish",
    "sv" => "Swedish",
    "ca" => "Catalan",
    "tl" => "Filipino",
    "iw" => "Hebrew",
    "id" => "Indonesian",
    "lv" => "Latvian",
    "lt" => "Lithuanian",
    "sr" => "Serbian",
    "sk" => "Slovak",
    "sl" => "Slovenian",
    "uk" => "Ukrainian",
    "vi" => "Vietnamese",
    "sq" => "Albanian",
    "et" => "Estonian",
    "gl" => "Galician",
    "hu" => "Hungarian",
    "mt" => "Maltese",
    "th" => "Thai",
    "tr" => "Turkish",
    "fa" => "Persian",
    "af" => "Afrikaans",
    "ms" => "Malay",
    "sw" => "Swahili",
    "ga" => "Irish",
    "cy" => "Welsh",
    "be" => "Belarusian",
    "is" => "Icelandic",
    "mk" => "Macedonian",
    "yi" => "Yiddish",
    "hy" => "Armenian",
    "az" => "Azerbaijani",
    "eu" => "Basque",
    "ka" => "Georgian",
    "ht" => "Haitian Creole",
    "ur" => "Urdu",
    "bn" => "Bengali",
    "bs" => "Bosnian",
    "ceb" => "Cebuano",
    "eo" => "Esperanto",
    "gu" => "Gujarati",
    "ha" => "Hausa",
    "hmn" => "Hmong",
    "ig" => "Igbo",
    "jw" => "Javanese",
    "kn" => "Kannada",
    "km" => "Khmer",
    "lo" => "Lao",
    "la" => "Latin",
    "mi" => "Maori",
    "mr" => "Marathi",
    "mn" => "Mongolian",
    "ne" => "Nepali",
    "pa" => "Punjabi",
    "so" => "Somali",
    "ta" => "Tamil",
    "te" => "Telugu",
    "yo" => "Yoruba",
    "zu" => "Zulu",
    "my" => "Myanmar (Burmese)",
    "ny" => "Chichewa",
    "kk" => "Kazakh",
    "mg" => "Malagasy",
    "ml" => "Malayalam",
    "si" => "Sinhala",
    "st" => "Sesotho",
    "su" => "Sudanese",
    "tg" => "Tajik",
    "uz" => "Uzbek",
    "am" => "Amharic",
    "co" => "Corsican",
    "haw" => "Hawaiian",
    "ku" => "Kurdish (Kurmanji)",
    "ky" => "Kyrgyz",
    "lb" => "Luxembourgish",
    "ps" => "Pashto",
    "sm" => "Samoan",
    "gd" => "Scottish Gaelic",
    "sn" => "Shona",
    "sd" => "Sindhi",
    "fy" => "Frisian",
    "xh" => "Xhosa"
];
@endphp

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <hr>
            <div class="row">
                @foreach($langs as $k => $lang)
                    <div class="col-md-3">
                        <div class="city-popular">
                            <p><a href="/{{ $k }}/">{{ $lang }}</a></p>
                            <p class="text-muted"></p>
                        </div>
                    </div>
                @endforeach

            </div>
            <br class="hidden-lg hidden-md hidden-sm">
        </div>

    </div>

</div>
@endsection

@section('head')
@endsection