<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use View;
use App\Models\Nota;
use Auth;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('currency', function ( $expression ) { return "<?php echo number_format($expression,0,',','.'); ?>"; });

        View::composer('layouts.home_mobile', function($view){
            $jumlah_nota = 0;
            if (Auth::user()){
                $jumlah_nota = Nota::where('user_id', Auth()->user()->id)->get()->count();                
            }
            $view->with(compact('jumlah_nota'));
        });
    }
}
