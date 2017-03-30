<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->delete();

        #### Dashboard (1)
        $route_dashboard = \App\Route::where('route_name', 'Dashboard')->first();
        $dashboard = new Menu();
        $dashboard->icon = 'icon-home';
        $dashboard->route_id = $route_dashboard->id;
        $dashboard->sequence = 1;
        $dashboard->save();

        $route_analytics = \App\Route::where('route_name', 'Analytics Dashboard')->first();
        $analytics = new Menu();
        $analytics->route_id = $route_analytics->id;
        $analytics->sequence = 1;
        $analytics->parent_menu = $dashboard->id;
        $analytics->save();

        #### Masterfile (2)
        $route_masterfile = \App\Route::where('route_name', 'Masterfile')->first();
        $masterfile = new Menu();
        $masterfile->route_id = $route_masterfile->id;
        $masterfile->sequence = 2;
        $masterfile->icon = 'icon-group';
        $masterfile->save();

        $route_addmf = \App\Route::where('route_name', 'Add Masterfile')->first();
        $add_mf = new Menu();
        $add_mf->route_id = $route_addmf->id;
        $add_mf->sequence = 1;
        $add_mf->parent_menu = $masterfile->id;
        $add_mf->save();

        $route_allmfs = \App\Route::where('route_name', 'All Masterfiles')->first();
        $all_mfs = new Menu();
        $all_mfs->route_id = $route_allmfs->id;
        $all_mfs->sequence = 2;
        $all_mfs->parent_menu = $masterfile->id;
        $all_mfs->save();

        $route_del_mfs = \App\Route::where('route_name', 'Deleted Masterfiles')->first();
        $del_mfs = new Menu();
        $del_mfs->route_id = $route_del_mfs->id;
        $del_mfs->sequence = 3;
        $del_mfs->parent_menu = $masterfile->id;
        $del_mfs->save();


        #### CRM (3)
        $route_crm = \App\Route::where('route_name', 'CRM')->first();
        $crm = new Menu();
        $crm->route_id = $route_crm->id;
        $crm->sequence = 3;
        $crm->icon = 'icon-user';
        $crm->save();

//        $route_staff = \App\Route::where('route_name', 'All Staff')->first();
//        $all_staff = new Menu();
//        $all_staff->route_id = $route_staff->id;
//        $all_staff->sequence = 1;
//        $all_staff->parent_menu = $crm->id;
//        $all_staff->save();

        $route_customer = \App\Route::where('route_name', 'All Customers')->first();
        $all_customer = new Menu();
        $all_customer->route_id = $route_customer->id;
        $all_customer->sequence = 2;
        $all_customer->parent_menu = $crm->id;
        $all_customer->save();

        #### Supplier Module
        $route_crm = \App\Route::where('route_name', 'Supplier')->first();
        $crm = new Menu();
        $crm->route_id = $route_crm->id;
        $crm->sequence = 3;
        $crm->icon = 'icon-user';
        $crm->save();

        $route_supplier = \App\Route::where('route_name', 'All Suppliers')->first();
        $all_supplier = new Menu();
        $all_supplier->route_id = $route_supplier->id;
        $all_supplier->sequence = 3;
        $all_supplier->parent_menu = $crm->id;
        $all_supplier->save();

        #### Documents Manager
        $inventory_menu = \App\Route::where('route_name','Documents Manager')->first();
        $inv_men =new Menu();
        $inv_men->route_id = $inventory_menu->id;
        $inv_men->sequence = 4;
        $inv_men->icon = 'icon-th';
        $inv_men->save();

        $route_cat = \App\Route::where('route_name','Manage Categories')->first();
        $menu = new Menu();
        $menu->route_id = $route_cat->id;
        $menu->parent_menu = $inv_men->id;
        $menu->sequence = 1;
        $menu->save();

        $route_subc = \App\Route::where('route_name','Upload a Document')->first();
        $menu = new Menu();
        $menu->route_id = $route_subc->id;
        $menu->parent_menu = $inv_men->id;
        $menu->sequence = 3;
        $menu->save();

        $route_subc = \App\Route::where('route_name','All Documents')->first();
        $menu = new Menu();
        $menu->route_id = $route_subc->id;
        $menu->parent_menu = $inv_men->id;
        $menu->sequence = 3;
        $menu->save();

        #### Auction (5)
        $route_action = \App\Route::where('route_name', 'Reports')->first();
        $auction = new Menu();
        $auction->route_id = $route_action->id;
        $auction->sequence = 4;
        $auction->icon = 'icon-list';
        $auction->save();

        $route_man_auctions = \App\Route::where('route_name', 'All Uploaded Documents')->first();
        $man_auctions = new Menu();
        $man_auctions->route_id = $route_man_auctions->id;
        $man_auctions->sequence = 1;
        $man_auctions->parent_menu = $auction->id;
        $man_auctions->save();

        #### User Management (7)
        $route_user_mgt = \App\Route::where('route_name', 'User Management')->first();
        $user_mgt = new Menu();
        $user_mgt->route_id = $route_user_mgt->id;
        $user_mgt->sequence = 7;
        $user_mgt->icon = 'icon-user';
        $user_mgt->save();

        $route_all_users = \App\Route::where('route_name', 'All Users')->first();
        $all_users = new Menu();
        $all_users->route_id = $route_all_users->id;
        $all_users->parent_menu = $user_mgt->id;
        $all_users->sequence = 1;
        $all_users->save();

        $route_roles = \App\Route::where('route_name', 'Roles')->first();
        $roles = new Menu();
        $roles->route_id = $route_roles->id;
        $roles->parent_menu = $user_mgt->id;
        $roles->sequence = 2;
        $roles->save();

        $route_roles = \App\Route::where('route_name', 'Audit Trail')->first();
        $roles = new Menu();
        $roles->route_id = $route_roles->id;
        $roles->parent_menu = $user_mgt->id;
        $roles->sequence = 3;
        $roles->save();

        #### System Manager (8)
        $route_system = \App\Route::where('route_name', 'System Manager')->first();
        $system = new Menu();
        $system->route_id = $route_system->id;
        $system->sequence = 8;
        $system->icon = 'icon-cogs';
        $system->save();

        $route_routes = \App\Route::where('route_name', 'Routes')->first();
        $routes = new Menu();
        $routes->route_id = $route_routes->id;
        $routes->parent_menu = $system->id;
        $routes->sequence = 1;
        $routes->save();

        $route_menu = \App\Route::where('route_name', 'Menu')->first();
        $menu = new Menu();
        $menu->route_id = $route_menu->id;
        $menu->parent_menu = $system->id;
        $menu->sequence = 2;
        $menu->save();

        $route_menu = \App\Route::where('route_name', 'System Actions')->first();
        $menu = new Menu();
        $menu->route_id = $route_menu->id;
        $menu->parent_menu = $system->id;
        $menu->sequence = 3;
        $menu->save();
    }
}