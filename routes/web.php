<?php

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('welcome');

Route::get('/home', 'UserController@home')->name('user.home');

Route::get('/quests', 'QuestController@allQuests')->name('quest.all');

Route::get('/{user}', 'UserController@allQuests')->name('user.all-quests');
Route::get('/{user}/profile', 'UserController@profile')->name('user.profile');
Route::get('/{user}/profile/edit', 'UserController@edit')->name('user.edit');
Route::put('/{user}/profile/update', 'UserController@update')->name('user.update');
Route::get('/{user}/in-process', 'UserController@questsInProcess')->name('user.quests-in-process');
Route::get('/{user}/finished', 'UserController@questsFinished')->name('user.quests-finished');
Route::get('/{user}/failed', 'UserController@questsFailed')->name('user.quests-failed');

Route::get('/{user}/quest/add', 'QuestController@add')->name('quest.add');
Route::post('/{user}/quest/create', 'QuestController@create')->name('quest.create');
Route::get('/{user}/{quest}/edit', 'QuestController@edit')->name('quest.edit');
Route::put('/{user}/{quest}/update', 'QuestController@update')->name('quest.update');
Route::get('/{user}/{quest}', 'QuestController@show')->name('quest.show');
Route::post('/{user}/{quest}/start', 'UserController@startQuest')->name('user.start-quest');
Route::post('/{user}/{quest}/finish', 'UserController@finishQuest')->name('user.finish-quest');