<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function hello($id) {
        $data = [
            'one' => 'You selected one',
            'two' => 'You selected two'
        ];
    
        if (!array_key_exists($id, $data)) {
            abort(404, 'Not found');
        }
    
        return $data[$id] ?? 'There is nothing';
    }
}
