<?php

namespace Dorcas\ModulesOps\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dorcas\ModulesOps\Models\ModulesOps;
use App\Dorcas\Hub\Utilities\UiResponse\UiResponse;
use App\Http\Controllers\HomeController;
use Hostville\Dorcas\Sdk;   
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use App\Dorcas\Hub\Enum\Banks;
use Carbon\Carbon;


class ModulesOpsController extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->data = [
            'page' => ['title' => config('modules-ops.title')],
            'header' => ['title' => config('modules-ops.title')],
            'selectedMenu' => 'modules-ops',
            'submenuConfig' => 'navigation-menu.modules-ops.sub-menu',
            'submenuAction' => ''
        ];
    }

    public function index()
    {
    	// $this->data['availableModules'] = HomeController::SETUP_UI_COMPONENTS;
    	return view('modules-ops::index', $this->data);
    }
    
    public function zoom_index(Request $request)
    {
        $this->data['page']['title'] .= ' &rsaquo; Zoom';
        $this->data['header']['title'] = 'Zoom Meeting';
        $this->data['selectedSubMenu'] = 'ops-zoom';
        $this->data['submenuAction'] = '';
        $this->setViewUiResponse($request);
        return view('modules-ops::zoom_index', $this->data);
    }

    public function zoom_create() {
        return view('modules-ops::zoom_create');
    }
}