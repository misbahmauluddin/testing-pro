<?php

namespace App\Http\Controllers;

use BaseHelper;
use Botble\Page\Models\Page;
use Botble\Page\Services\PageService;
use Botble\Theme\Events\RenderingHomePageEvent;
use Botble\Theme\Events\RenderingSingleEvent;
use Botble\Theme\Events\RenderingSiteMapEvent;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Response;
use SeoHelper;
use SiteMapManager;
use SlugHelper;
use Theme;


class CustomerController extends Controller
{
    public function index()
    {
        SeoHelper::setTitle('Customer Dashboard');
        
        return Theme::scope('customer.customer')->render();
    }
}
