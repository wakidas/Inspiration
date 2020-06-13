<?php

namespace inspiration\Http\Controllers;

use Illuminate\Http\Request;
use inspiration\User;

class UserController extends Controller
{
    public function delete($id)
    {
        User::find($id)->delete(); // softDelete

        return redirect()->route('/');
    }
}
