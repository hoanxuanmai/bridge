<?php
/**
 * Created by Mai Xuân Hoàn
 * @author hoanxuanmai@gmail.com
 * @link https://hoanxuanmai.github.io
 */

namespace HXM\Bridge\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HookController extends Controller
{
    public function __invoke(Request $request)
    {
        return response()->json([ 'status'=> 200 ]);
    }
}
