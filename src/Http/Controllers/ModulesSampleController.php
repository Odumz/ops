<?php

namespace Dorcas\ModulesSample\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dorcas\ModulesSample\Models\ModulesSample;
use App\Dorcas\Hub\Utilities\UiResponse\UiResponse;
use App\Http\Controllers\HomeController;
use Hostville\Dorcas\Sdk;   
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use App\Dorcas\Hub\Enum\Banks;
use Carbon\Carbon;


class ModulesSampleController extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->data = [
            'page' => ['title' => config('modules-sample.title')],
            'header' => ['title' => 'Sample Module'],
            'selectedMenu' => 'modules-sample',
            'submenuConfig' => 'navigation-menu.addons.sub-menu.modules-sample.sub-menu',
            'submenuAction' => ''
        ];
    }

    public function index()
    {
    	return view('modules-sample::index', $this->data);
    }

   

}