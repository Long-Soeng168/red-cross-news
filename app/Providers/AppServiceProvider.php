<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\WebsiteInfo;
use App\Models\Database;
use App\Models\Footer;
use App\Models\Link;
use App\Models\Menu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $websiteInfo = WebsiteInfo::first() ?? new WebsiteInfo;
        View::share('websiteInfo', $websiteInfo);

        $menu_databases = Database::where('status', 1)->orderBy('order_index', 'ASC')->get() ?? new Database;
        View::share('menu_databases', $menu_databases);

        $menu_database_default = new Database;
        $menu_database_default['name'] = 'All';
        $menu_database_default['name_kh'] = 'ទាំងអស់';
        $menu_database_default['slug'] = 'one_search';
        View::share('menu_database_default', $menu_database_default);

        $footer = Footer::first() ?? new Footer;
        View::share('footer', $footer);

        $links = Link::orderBy('order_index', 'ASC')->get() ?? new Link;
        View::share('links', $links);

        $menu_pages = Menu::orderBy('order_index', 'ASC')->get() ?? new Menu;
        View::share('menu_pages', $menu_pages);
    }
}
