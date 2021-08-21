<?php

Route::group(['middleware' => ['web', 'permission:deals.browse'], 'prefix' => 'deals', 'as' => 'deals.', 'namespace' => 'Modules\Deals\Http\Controllers'], function () {
    Route::get('/','DealsController@indexRedirect');

    Route::group(['middleware' => ['web', 'permission:deals.settings']], function () {
        Route::resource('stage', 'Settings\StageController');
        Route::resource('status', 'Settings\StatusController');
        Route::resource('businesstype', 'Settings\BusinessTypeController');
    });

    Route::resource('deals', 'DealsController');

    Route::get('deals/convert_to_deal/{id}', ['as'=>'deals.convert.to.quote','uses'=> 'DealsController@convertToQuote']);

    Route::get('deals/submit-status/{id}/{status}', ['as'=>'submit.status','uses'=> 'DealsController@submitStatus']);


    Route::post('deals/mass_update', ['as'=>'deals.mass_update','uses'=> 'DealsController@massUpdate']);


    Route::get('deals/contacts-selection/{entityId}', ['as'=>'contacts.selection','uses'=> 'Tabs\DealsContactsController@selection']);
    Route::get('deals/contacts-linked/{entityId}', ['as'=>'contacts.linked','uses'=> 'Tabs\DealsContactsController@linked']);
    Route::post('deals/contacts-unlink', ['as'=>'contacts.unlink','uses'=> 'Tabs\DealsContactsController@unlink']);
    Route::post('deals/contacts-link', ['as'=>'contacts.link','uses'=> 'Tabs\DealsContactsController@link']);


    Route::get('deals/calls-selection/{entityId}', ['as'=>'calls.selection','uses'=> 'Tabs\DealsCallsController@selection']);
    Route::get('deals/calls-linked/{entityId}', ['as'=>'calls.linked','uses'=> 'Tabs\DealsCallsController@linked']);
    Route::post('deals/calls-unlink', ['as'=>'calls.unlink','uses'=> 'Tabs\DealsCallsController@unlink']);
    Route::post('deals/calls-link', ['as'=>'calls.link','uses'=> 'Tabs\DealsCallsController@link']);

    Route::get('deals/quotes-selection/{entityId}', ['as'=>'quotes.selection','uses'=> 'Tabs\DealsQuotesController@selection']);
    Route::get('deals/quotes-linked/{entityId}', ['as'=>'quotes.linked','uses'=> 'Tabs\DealsQuotesController@linked']);
    Route::post('deals/quotes-unlink', ['as'=>'quotes.unlink','uses'=> 'Tabs\DealsQuotesController@unlink']);
    Route::post('deals/quotes-link', ['as'=>'quotes.link','uses'=> 'Tabs\DealsQuotesController@link']);

});
