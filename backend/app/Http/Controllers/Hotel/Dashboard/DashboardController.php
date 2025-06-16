<?php

namespace App\Http\Controllers\Hotel\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
      public function __construct()
    {
        parent::__construct();
    }


    public function getView()
    {
        return [
            'index' => 'hotel.dashboard.index',
        ];
    }
    public function index()
    {
        return view($this->view['index']);
    } 
}
