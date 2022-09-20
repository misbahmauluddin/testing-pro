<?php

use Botble\RealEstate\Models\Project;
use Botble\RealEstate\Models\Property;
use App\Http\Controllers\SliderkuController;
use App\Http\Controllers\CustomerController;

// Custom routes
Route::group(['namespace' => 'Theme\FlexHome\Http\Controllers', 'middleware' => ['web', 'core']], function () {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {
        Route::get(SlugHelper::getPrefix(Project::class, 'projects') . '/city/{slug?}', 'FlexHomeController@getProjectsByCity')
            ->name('public.project-by-city');

        Route::get(SlugHelper::getPrefix(Property::class, 'properties') . '/city/{slug?}', 'FlexHomeController@getPropertiesByCity')
            ->name('public.properties-by-city');

        Route::get('agents', 'FlexHomeController@getAgents')->name('public.agents');
        Route::get('agents/{username}', 'FlexHomeController@getAgent')->name('public.agent');

        Route::get('wishlist', 'FlexHomeController@getWishlist')->name('public.wishlist');

        Route::get('ajax/cities', 'FlexHomeController@ajaxGetCities')->name('public.ajax.cities');
        Route::get('ajax/properties', 'FlexHomeController@ajaxGetProperties')->name('public.ajax.properties');
        Route::get('ajax/posts', 'FlexHomeController@ajaxGetPosts')->name('public.ajax.posts');
        Route::get('ajax/properties/map', 'FlexHomeController@ajaxGetPropertiesForMap')->name('public.ajax.properties.map');

        Route::get('ajax/agents/featured', 'FlexHomeController@ajaxGetFeaturedAgents')->name('public.ajax.featured-agents');
    });
});

Theme::routes();

Route::group(['namespace' => 'Theme\FlexHome\Http\Controllers', 'middleware' => ['web', 'core']], function () {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {

        Route::get('/', 'FlexHomeController@getIndex')->name('public.index');

        Route::get('sitemap.xml', [
            'as'   => 'public.sitemap',
            'uses' => 'FlexHomeController@getSiteMap',
        ]);

        Route::get('{slug?}' . config('core.base.general.public_single_ending_url'), [
            'as'   => 'public.single',
            'uses' => 'FlexHomeController@getView',
        ]);

        // SLIDERKU
        Route::get('/admin/sliderku', [SliderkuController::class, 'index'])->name('sliderku');
        Route::post('/admin/sliderku/data', [SliderkuController::class, 'data'])->name('sliderku.data');
        Route::post('sliderku', [SliderkuController::class, 'store'])->name('sliderku.store');
        Route::get('/admin/sliderku/edit/view/{id}', [SliderkuController::class, 'show'])->name('sliderku.edit.view');

        Route::get('/admin/homeView', [SliderkuController::class, 'HomeView'])->name('homeView');
        Route::post('/admin/sliderku/hapus', [SliderkuController::class, 'destroy'])->name('sliderku.destroy');

        // CUSTOMER CONTROLLER
        Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
    });
});
