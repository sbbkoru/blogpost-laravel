<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */

/* Route::get('/', function(){
    return view('home.index', []);
})->name('home.index');

Route::get('/contact', function(){
    // NAMING ROUTES
    return 'Contact list';
})->name('home.contact'); */

Route::get('/', [HomeController::class, 'home'])
->name('home.index');
Route::get('/contact', [HomeController::class, 'contact'])
->name('home.contact');
Route::get('/secret', [HomeController::class, 'secret'])
->name('secret')->middleware('can:home.secret');

Route::get('/single', AboutController::class); // INVOKE FUNCTION

// Route::view('/', 'home.index')->name('home.index');
// Route::view('/contact', 'home.contact')->name('home.contact');

Route::get('/blogs/{id}', function($id){
    // BİRDEN FAZLA ROUTE KOYMAK
    return 'Blog post ' . $id;
});

Route::get('/recent-posts/{daysago?}', function($daysAgo = 20) {
    // OPTIONAL ROUTE PARAMETERS - SORU İŞARETİ
    return 'Posts are ' . $daysAgo . ' days ago';
})->name('recent.posts.index');

Route::resource('posts', PostsController::class);

Auth::routes();
//->only('index','show', 'create', 'store', 'edit' ,'update');

/* Route::get('/posts', function() use ($posts){ //
    // dd(request()->all());
    // dd(request()->query('page', 2));
return view('lists.posts', ['posts' => $posts]);
});

Route::get('lists/{post}', function($post){
    $posts = [
        1 => [
            'title' => 'Intro to Laravel',
            'content' => 'This is a short intro to Laravel',
            'is_new' => true,
            'has_comments' => true
        ],
        2 => [
            'title' => 'Intro to PHP',
            'content' => 'This is a short intro to PHP',
            'is_new' => false
        ],
        3 => [
            'title' => 'Intro to Javascript',
            'content' => 'This is a short intro to Javascript',
            'is_new' => false
        ]];
    return view('lists.show', ['post' => $posts[$post]]);
})->name('lists.show');*/

Route::get('/posts/{id}', function($id){
    return 'post ' . $id;
})->where([ // ID PARAMETERINI SAYILARLA KISITLAMAK
    'id' => '[0-9]+'
]);

Route::get('/price', function(){
    // NAMING ROUTES
    return view('home.price');
})->name('home.price');



$posts = [
    1 => [
        'title' => 'Intro to Laravel',
        'content' => 'This is a short intro to Laravel',
        'is_new' => true,
        'has_comments' => true
    ],
    2 => [
        'title' => 'Intro to PHP',
        'content' => 'This is a short intro to PHP',
        'is_new' => false
    ],
    3 => [
        'title' => 'Intro to Javascript',
        'content' => 'This is a short intro to Javascript',
        'is_new' => false
    ]
];



Route::get('/fun/responses', function() use ($posts) {
    return response($posts, 201)
    ->header('Content-Type', 'application/json')
    ->cookie('MY_COOKIE', 'Berkay Koru', 3600);
});

/* Route::get('/fun/redirect', function(){
return redirect('/contact');
});

Route::get('/fun/back', function(){
    return back();
});

Route::get('/fun/named-route', function(){
    return redirect()->route('lists.show', ['list' => 1]);
});

Route::get('/fun/away', function(){
    return redirect()->away('https://google.com');
});

Route::get('/fun/json', function() use ($sorts){
    return response()->json($sorts);
});

Route::get('/fun/download', function(){
    return response()->download(public_path('/tiger.jpg', 'animal.jpg'));
}); */

Route::prefix('/fun')->name('fun.')->group(function() use($posts){ // ROUTE GRUPLAMA
    Route::get('redirect', function(){
        return redirect('/contact');
        })->name('redirect');

        Route::get('back', function(){
            return back();
        })->name('back');

        Route::get('named-route', function(){
            return redirect()->route('lists.show', ['list' => 1]);
        })->name('named-route');

        Route::get('away', function(){
            return redirect()->away('https://google.com');
        })->name('away');

        Route::get('json', function() use ($posts){
            return response()->json($posts);
        })->name('json');

        Route::get('download', function(){
            return response()->download(public_path('/tiger.jpg', 'animal.jpg'));
        })->name('download');
});


