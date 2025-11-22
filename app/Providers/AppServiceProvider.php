<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

	public function register(): void
	{
		
	}

	public function boot(): void
	{

		Blade::directive('formatDate', function ($expression) {
			return "<?php echo {$expression} ? \\Carbon\\Carbon::parse({$expression})->format('d/m/Y') : '-'; ?>";
		});

		Blade::directive('formatDateTime', function ($expression) {
			return "<?php echo {$expression} ? \\Carbon\\Carbon::parse({$expression})->format('d/m/Y H:i') : '-'; ?>";
		});

		Blade::if('hasRole', function ($roleName) {
			return auth()->check() && auth()->user()->hasActiveRole($roleName);
		});
	}
}
