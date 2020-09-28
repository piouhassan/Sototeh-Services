<?php


namespace App\Http\Controllers;



class RedirectsController
{

    public function facebook()
    {
        return  redir('https://www.facebook.com/akurengroup');
    }

}