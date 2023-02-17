<?php

namespace App\Http\Controllers;

use App\Models\BaseModel;
use App\Services\MessageService;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $auth;

    /**
     * @var BaseModel
     */
    private $baseModel;
    private $baseController;


    public function __construct(
        Guard $auth,
        BaseModel $baseModel
    )
    {
        $this->auth= $auth;
//        $this->middleware('auth')->except('index','registrationPage');

        $this->baseModel = $baseModel;

    }

    public function index()
    {
       echo('Welcome to Trial test!!!<br>Developed by Resoft');
    }

    public function migrate()
    {
        try {

            echo '<br>init with app tables migrations...';
            \Artisan::call('migrate',
                array(
                    '--path' => 'database/migrations',
                    '--force' => true));
            echo '<br>done with app tables migrations';

        } catch (Exception $e) {
            Response::make($e->getMessage(), 500);
        }
    }

    public function migrateRollback()
    {
        try {

            echo '<br>init with app tables migrations rollback...';
            \Artisan::call('migrate:rollback',
                array(
                    '--path' => 'database/migrations',
                    '--force' => true));
            echo '<br>done with app tables migrations rollback';

        } catch (Exception $e) {
            Response::make($e->getMessage(), 500);
        }
    }
}
