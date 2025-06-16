<?php

namespace App\Http\Controllers;

use App\Enums\User\UserRole;
use App\Support\Breadcrumb\Breadcrumb;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * Mảng chứa đường dẫn tới views
     *
     * @var array
     */
    protected $view;
    /**
     * Mảng chứa tên route
     *
     * @var array
     */
    protected $route;

    protected Breadcrumb $crums;
    public function __construct()
    {

        $this->setView();

        $this->setRoute();

        $this->middleware(function ($request, $next) {
            $user = auth()->user();

            if ($user && $user->role === UserRole::Admin) {
                $url = route('admin.dashboard');
            } elseif ($user) {
                $url = route('hotel.dashboard', ['hotel_id' => $user->id]);
            } else {
                $url = '#'; 
            }

            $this->crums = (new Breadcrumb())->add(__('Dashboard'), $url);

            return $next($request);
        });
        // $this->crums = (new Breadcrumb())->add(__('Dashboard'), route('admin.dashboard'));
    }

    public function getView()
    {
        return $this->view ?? [];
    }

    public function setView()
    {
        $this->view = $this->getView();
    }

    public function getRoute()
    {
        return $this->route ?? [];
    }

    public function setRoute()
    {
        $this->route = $this->getRoute();
    }
}
