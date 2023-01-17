<?php
/**
 * Created by Mai Xuân Hoàn
 * @author hoanxuanmai@gmail.com
 * @link https://hoanxuanmai.github.io
 */

use Illuminate\Support\Facades\Route;

Route::any('', \HXM\Bridge\Http\Controllers\HookController::class);
