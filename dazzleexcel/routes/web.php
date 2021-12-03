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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'frontend\FrontendController@index');

Route::get('currencyswitch', 'frontend\CurrencywitcherController@currencyswitch');
Route::get('/productdetail/welcome/pagination/{id}', 'frontend\ProductsController@fetch_data');
Route::get('/productlisting/welcome/paginationlist/{id}', 'frontend\ProductsController@fetch_datas');


Route::get('productlisting/option/{id}', 'frontend\ProductsController@productoption');


Route::get('/searchresult/welcome/paginationlist/{id}', 'frontend\SearchController@fetch_datas');

Route::get('searchresult/option/{id}', 'frontend\ProductsController@productoption');


Route::get('/welcome/paginationluxury', 'frontend\luxuryproductsController@fetch_data');

Route::get('quickviewluxury', 'frontend\luxuryproductsController@getquickviewdata');

Route::get('optionluxury', 'frontend\luxuryproductsController@productoption');

Route::get('productlisting/{id}', 'frontend\ProductsController@productlisting');
Route::get('womenproducts', 'frontend\ProductsController@womenproducts');
Route::get('childproducts', 'frontend\ProductsController@childproduct');
Route::get('productdetail/{id}', 'frontend\ProductsController@productdetail');
Route::get('searchresult/{key}', 'frontend\SearchController@searchresult');
Route::get('loginregister', 'frontend\CustomerController@login');
Route::post('register', 'frontend\CustomerController@registercustomer');
Route::post('customerlogin', 'frontend\CustomerController@customerlogin');
Route::resource('customdesigning', 'frontend\CustomdesignController');
Route::get('customize', 'frontend\CustomdesignController@customize');
Route::get('custompayment/{id}', 'admin\CustomdesignController@paycustom');
Route::post('updatepayment', 'admin\CustomdesignController@updatepayment');
Route::get('custompaymentsuccess', 'admin\CustomdesignController@paymentsuccess');
Route::get('testimonial', 'frontend\TestimonialController@testimonialhome');
Route::get('quickview', 'frontend\ProductsController@getquickviewdata');
Route::resource('luxury', 'frontend\luxuryproductsController');
Route::resource('subscription', 'frontend\SubscriptionController');
Route::get('catimages', 'frontend\FrontendController@menucatimages');
Route::resource('deals', 'frontend\DealsController');
Route::get('questlogin', 'frontend\CustomerController@questcheckoutpart');
Route::resource('questcheckout', 'frontend\questcheckoutController');
Route::get('disablenotification', 'frontend\FrontendController@notificationdisble');
Route::post('sortlist', 'frontend\ProductsController@sortingdata');
Route::get('sortlist', 'frontend\ProductsController@sortingdata');
Route::post('productsearch', 'frontend\SearchController@search');

Route::get('/sociallogin/{social}','frontend\SocialController@socialLogin')->where('social','twitter|facebook|linkedin|google|github|bitbucket');
Route::get('/sociallogin/{social}/callback','frontend\SocialController@handleProviderCallback')->where('social','twitter|facebook|linkedin|google|github|bitbucket');

Route::get('help', 'frontend\Pagesontroller@help');
Route::get('termsandconditions', 'frontend\Pagesontroller@termscondition');
Route::get('privacypolicy', 'frontend\Pagesontroller@privacypolicy');
Route::get('returnpolicy', 'frontend\Pagesontroller@returnpolicy');
Route::get('deliverypolicy', 'frontend\Pagesontroller@deliverypolicy');
Route::get('aboutus', 'frontend\Pagesontroller@about');
Route::get('contactus', 'frontend\Pagesontroller@contact');
Route::post('sendenquiry', 'frontend\Pagesontroller@contactmail');
Route::get('pagination/fetch_data', 'frontend\ProductsController@fetch_data');

Route::get('paypal', array('as' => 'payment.status','uses' => 'frontend/PaypalController@getPaymentStatus',));


Route::group(['prefix' => 'customer'],function(){

Route::get('account', 'frontend\CustomerController@account');
Route::post('updateprofilepic', 'frontend\CustomerController@changepeofileimage');
Route::post('updateprofile', 'frontend\CustomerController@profileupdate');
Route::post('addtocart/{id}', 'frontend\CartController@addtocart');
Route::get('cartadd/{id}', 'frontend\CartController@addtocart');
Route::get('deleteitem/{id}', 'frontend\CartController@deleteitem');
Route::get('logout', 'frontend\CustomerController@logout');
Route::resource('carts', 'frontend\CartController');
Route::resource('checkout', 'frontend\CheckoutController');
Route::post('validatecoupons', 'frontend\CheckoutController@validatecoupon');
Route::resource('orders', 'frontend\OrderController');
Route::resource('testimonials', 'frontend\TestimonialController');
Route::resource('wishlist', 'frontend\wishlistController');
Route::get('deletewishlist/{id}', 'frontend\wishlistController@destroy');
Route::resource('custompaynow', 'frontend\paynowController');
Route::resource('addresses', 'frontend\AddressController');
Route::get('getsavedaddress', 'frontend\AddressController@getaddress');
Route::resource('luxury', 'frontend\AddressController');
Route::resource('reviews', 'frontend\ReviewController');
Route::resource('notification', 'frontend\NotificationController');
Route::post('cardpayment', 'frontend\CheckoutController@cardpayment');
Route::get('cardpaymentpage/{id}', 'frontend\CheckoutController@cardpaymentpage');






Route::get('status', 'frontend/PaypalController@getPaymentStatus');


});
//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('api/getcategory', 'admin\ApiController@get_category');
Route::get('api/getsubcategory', 'admin\ApiController@get_subcategory');
Route::get('api/getproducts', 'admin\ApiController@get_products');
Route::group(['prefix' => 'manage'],function(){

	Route::get('/', 'admin\LoginController@index')->name('admin');
	Route::post('validatecredential', 'admin\LoginController@validate_credentials');
	 Route::group( [ 'middleware' => ['auth:admin'] ], function(){
	Route::resource('dashboard', 'admin\DashboardController');
	Route::resource('categories', 'admin\CategoryController');
	Route::resource('products', 'admin\ProductsController');
	Route::resource('normalproducts', 'admin\NormalproductsController');
	Route::resource('colours', 'admin\ColourController');
	Route::resource('size', 'admin\SizeController');
	Route::resource('banner', 'admin\BannerController');
	Route::resource('segments', 'admin\SegmentController');
	Route::resource('orders', 'admin\OrderController');
	// Route::get('updatestatus', 'admin\OrderController@updatestatus');
	Route::resource('dresstype', 'admin\DresstypeController');
	Route::resource('dressmaterial', 'admin\DressmaterialController');
	Route::resource('customdesigning', 'admin\CustomdesignController');
	Route::get('updateordersstatus/{id}', 'admin\OrderController@updateorderstatus');
	Route::post('updatestatus', 'admin\OrderController@updatestatus');
	Route::get('updateshippings/{id}', 'admin\OrderController@updateordershipping');
	Route::post('updateshippingmethod', 'admin\OrderController@updateshippingmethod');
	Route::get('menufeatured/{id}', 'admin\NormalproductsController@menufeature');
	Route::post('uploads', 'admin\ProductsController@uploadProducts');
	Route::post('uploadsnormal', 'admin\NormalproductsController@uploadProducts');
	Route::post('makemenufeatured', 'admin\NormalproductsController@makefeatured');
	Route::resource('offers', 'admin\OffersController');
	Route::resource('notification', 'admin\NotificationController');
	Route::resource('coupons', 'admin\Couponscontroller');

	
	Route::post('productimages', 'admin\ProductsController@upload_productimages');
	Route::post('bannerimages', 'admin\BannerController@upload_bannerimages');
	Route::get('removebannerimage/{id}', 'admin\BannerController@removebannerimages');
	Route::get('removesummaryimage/{id}', 'admin\ProductsController@removesummaryimages');
	Route::get('removedescrimage/{id}', 'admin\ProductsController@removedescriptionimages');
	Route::get('removeproductimage/{id}', 'admin\ProductsController@removeproductimages');
	Route::get('removenormalproductimage/{id}', 'admin\NormalproductsController@removeproductimages');
	Route::get('removedesignerimage/{id}', 'admin\ProductsController@removedesignerimages');
	Route::get('addtosegment', 'admin\SegmentController@addtosegment');
	Route::resource('pages', 'admin\PagesController');
	Route::get('changepassword', 'admin\DashboardController@changepassword');
	Route::post('reviewsdelete/{id}', 'admin\NormalproductsController@deletereviews');




	Route::get('logout', 'admin\DashboardController@logout');
	 });
});
