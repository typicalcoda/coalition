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

Route::get('/', function () {
	return view('index');
});


Route::post('store', function(){
	$product = request('product');
	if(strlen(file_get_contents('products.json')) > 0){
		$products = json_decode(file_get_contents('products.json'));
	} 
	else $products = array();
	array_push($products, $product);
	file_put_contents("products.json", json_encode($products, true));
	return response()->json(['msg' => 'Success! Your product has been saved', 'products' => $products]);
});

Route::get('products', function(){
	$product = request('product');
	if(strlen(file_get_contents('products.json')) > 0){
		$products = json_decode(file_get_contents('products.json'));
	} 
	else $products = array();
	return response()->json(['msg' => 'Success! Your product has been saved', 'products' => $products]);
});