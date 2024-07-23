<?php

namespace App\Http\Controllers\UserPanels\Navigate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserPanelController extends Controller
{
    //
    public function index()
    {
         $process = $this->setPageSession("Dashboard", "dashboard");
         if ($process) {
             $data = [
                 'quote' => $this->getQuote(),
             ];
             return $this->setReturnView('pages/userpanels/p_dashboard', $data);
         }
    }
}
