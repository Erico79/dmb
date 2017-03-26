<?php

use Illuminate\Database\Seeder;
use App\Route;
use App\Role;
use Illuminate\Support\Facades\DB;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('routes')->delete();

        $admin = Role::where('role_code', 'SYS_ADMIN')->first();
        #### Dashboard
        $dashboard = new Route();
        $dashboard->route_name = 'Dashboard';
        $dashboard->save();
        $dashboard_id = $dashboard->id;

        $analytics = new Route();
        $analytics->route_name = 'Analytics Dashboard';
        $analytics->url = 'dashboard';
        $analytics->parent_route = $dashboard_id;
        $analytics->save();
        $analytics->roles()->attach($admin);

        #### Masterfile
        $mf = new Route();
        $mf->route_name = 'Masterfile';
        $mf->save();
        $mf_id = $mf->id;

        $add_mf = new Route();
        $add_mf->route_name = 'Add Masterfile';
        $add_mf->url = 'masterfile';
        $add_mf->parent_route = $mf_id;
        $add_mf->save();
        $add_mf->roles()->attach($admin);

        $all_mf = new Route();
        $all_mf->route_name = 'All Masterfiles';
        $all_mf->url = 'all_mfs';
        $all_mf->parent_route = $mf_id;
        $all_mf->save();
        $all_mf->roles()->attach($admin);

        $del_mfs = new Route();
        $del_mfs->route_name = 'Deleted Masterfiles';
        $del_mfs->url = 'deleted_mfs';
        $del_mfs->parent_route = $mf_id;
        $del_mfs->save();
        $del_mfs->roles()->attach($admin);

        #### CRM
        $crm = new Route();
        $crm->route_name = 'CRM';
        $crm->save();
        $crm_id = $crm->id;

//        $all_staff = new Route();
//        $all_staff->route_name = 'All Staff';
//        $all_staff->url = 'all-staff';
//        $all_staff->parent_route = $crm_id;
//        $all_staff->save();
//        $all_staff->roles()->attach($admin);

        $all_customers = new Route();
        $all_customers->route_name = 'All Customers';
        $all_customers->url = 'all-customers';
        $all_customers->parent_route = $crm_id;
        $all_customers->save();
        $all_customers->roles()->attach($admin);

        #### Suppliers
        $crm = new Route();
        $crm->route_name = 'Supplier';
        $crm->save();
        $crm_id = $crm->id;

        $all_supplier = new Route();
        $all_supplier->route_name = 'All Suppliers';
        $all_supplier->url = 'all-suppliers';
        $all_supplier->parent_route = $crm_id;
        $all_supplier->save();
        $all_supplier->roles()->attach($admin);

        #### Inventory
        $inventory = new Route();
        $inventory->route_name = 'Documents Manager';
        $inventory->save();
        $inventory_id = $inventory->id;

        $all_supplier = new Route();
        $all_supplier->route_name = 'Manage Categories';
        $all_supplier->url = 'categories';
        $all_supplier->parent_route = $inventory_id;
        $all_supplier->save();
        $all_supplier->roles()->attach($admin);

        $all_supplier = new Route();
        $all_supplier->route_name = 'Add Categories';
        $all_supplier->url = 'add-category';
        $all_supplier->parent_route = $inventory_id;
        $all_supplier->save();
        $all_supplier->roles()->attach($admin);

        $all_supplier = new Route();
        $all_supplier->route_name = 'Get Category Details';
        $all_supplier->url = 'category-details/{id}';
        $all_supplier->parent_route = $inventory_id;
        $all_supplier->save();
        $all_supplier->roles()->attach($admin);

        $all_supplier = new Route();
        $all_supplier->route_name = 'Update Category';
        $all_supplier->url = 'update-category/{id}';
        $all_supplier->parent_route = $inventory_id;
        $all_supplier->save();
        $all_supplier->roles()->attach($admin);

        $all_supplier = new Route();
        $all_supplier->route_name = 'Delete Category';
        $all_supplier->url = 'delete-category/{id}';
        $all_supplier->parent_route = $inventory_id;
        $all_supplier->save();
        $all_supplier->roles()->attach($admin);

        $all_supplier = new Route();
        $all_supplier->route_name = 'Upload a Document';
        $all_supplier->url = 'sub-categories';
        $all_supplier->parent_route = $inventory_id;
        $all_supplier->save();
        $all_supplier->roles()->attach($admin);

        $all_supplier = new Route();
        $all_supplier->route_name = 'All Documents';
        $all_supplier->url = 'all-docs';
        $all_supplier->parent_route = $inventory_id;
        $all_supplier->save();
        $all_supplier->roles()->attach($admin);

        #### Reports
        $route = new Route();
        $route->route_name = 'Reports';
        $route->save();
        $parent_id = $route->id;

        $route = new Route();
        $route->route_name = 'All Uploaded Documents';
        $route->url = 'all-uploaded-docs';
        $route->parent_route = $parent_id;
        $route->save();
        $route->roles()->attach($admin);

        #### User Management
        $user_management = new Route();
        $user_management->route_name = 'User Management';
        $user_management->save();
        $user_mgt_id = $user_management->id;

        $all_users = new Route();
        $all_users->route_name = 'All Users';
        $all_users->url = 'all-users';
        $all_users->parent_route = $user_mgt_id;
        $all_users->save();
        $all_users->roles()->attach($admin);

        $all_users = new Route();
        $all_users->route_name = 'Load all Users';
        $all_users->url = 'load-users';
        $all_users->parent_route = $user_mgt_id;
        $all_users->save();
        $all_users->roles()->attach($admin);

        $all_users = new Route();
        $all_users->route_name = 'Reset User Password';
        $all_users->url = 'reset-pass';
        $all_users->parent_route = $user_mgt_id;
        $all_users->save();
        $all_users->roles()->attach($admin);

        $all_users = new Route();
        $all_users->route_name = 'Delete User Account';
        $all_users->url = 'delete-user';
        $all_users->parent_route = $user_mgt_id;
        $all_users->save();
        $all_users->roles()->attach($admin);

        $all_users = new Route();
        $all_users->route_name = 'Get User data records';
        $all_users->url = 'user-data/{id}';
        $all_users->parent_route = $user_mgt_id;
        $all_users->save();
        $all_users->roles()->attach($admin);

        $all_users = new Route();
        $all_users->route_name = 'Deactivate User Account';
        $all_users->url = 'block-user';
        $all_users->parent_route = $user_mgt_id;
        $all_users->save();
        $all_users->roles()->attach($admin);

        $all_users = new Route();
        $all_users->route_name = 'Activate User Account';
        $all_users->url = 'unblock-user';
        $all_users->parent_route = $user_mgt_id;
        $all_users->save();
        $all_users->roles()->attach($admin);

        $all_users = new Route();
        $all_users->route_name = 'User Account Profile';
        $all_users->url = 'user_profile/{id}';
        $all_users->parent_route = $user_mgt_id;
        $all_users->save();
        $all_users->roles()->attach($admin);

        $all_users = new Route();
        $all_users->route_name = 'User Account Audit Trail';
        $all_users->url = 'user_profile/user-audit/{id}';
        $all_users->parent_route = $user_mgt_id;
        $all_users->save();
        $all_users->roles()->attach($admin);

        $all_users = new Route();
        $all_users->route_name = 'My Profile Settings';
        $all_users->url = 'profile-settings';
        $all_users->parent_route = $user_mgt_id;
        $all_users->save();
        $all_users->roles()->attach($admin);

        $all_users = new Route();
        $all_users->route_name = 'My Profile Audit';
        $all_users->url = 'profile-settings/profile-audit/{id}';
        $all_users->parent_route = $user_mgt_id;
        $all_users->save();
        $all_users->roles()->attach($admin);

        $roles = new Route();
        $roles->route_name = 'Roles';
        $roles->url = 'user-roles';
        $roles->parent_route = $user_mgt_id;
        $roles->save();
        $roles->roles()->attach($admin);

        $audit_trail = new Route();
        $audit_trail->route_name = 'Audit Trail';
        $audit_trail->url = 'audit_trails';
        $audit_trail->parent_route = $user_mgt_id;
        $audit_trail->save();
        $audit_trail->roles()->attach($admin);

        $audit_trail = new Route();
        $audit_trail->route_name = 'Get Audit Trail';
        $audit_trail->url = 'load-audit';
        $audit_trail->parent_route = $user_mgt_id;
        $audit_trail->save();
        $audit_trail->roles()->attach($admin);

        #### System Manager
        $system_manager = new Route();
        $system_manager->route_name = 'System Manager';
        $system_manager->save();
        $sys_id = $system_manager->id;

        $routes = new Route();
        $routes->route_name = 'Routes';
        $routes->url = 'routes';
        $routes->parent_route = $sys_id;
        $routes->save();
        $routes->roles()->attach($admin);

        $route = new Route();
        $route->route_name = 'Load Routes';
        $route->url = 'load-routes';
        $route->parent_route = $sys_id;
        $route->save();
        $route->roles()->attach($admin);

        $route = new Route();
        $route->route_name = 'Add Route';
        $route->url = 'add-route';
        $route->parent_route = $sys_id;
        $route->save();
        $route->roles()->attach($admin);

        $route = new Route();
        $route->route_name = 'Get System Routes';
        $route->url = 'get-routes';
        $route->parent_route = $sys_id;
        $route->save();
        $route->roles()->attach($admin);

        $route = new Route();
        $route->route_name = 'Get Route';
        $route->url = 'get-route/{id}';
        $route->parent_route = $sys_id;
        $route->save();
        $route->roles()->attach($admin);

        $route = new Route();
        $route->route_name = 'Update System Route';
        $route->url = 'update-route';
        $route->parent_route = $sys_id;
        $route->save();
        $route->roles()->attach($admin);

        $route = new Route();
        $route->route_name = 'Delete System Route';
        $route->url = 'delete-route';
        $route->parent_route = $sys_id;
        $route->save();
        $route->roles()->attach($admin);

        $route = new Route();
        $route->route_name = 'Load Routes';
        $route->url = 'load-routes';
        $route->parent_route = $sys_id;
        $route->save();
        $route->roles()->attach($admin);

        $menu = new Route();
        $menu->route_name = 'Menu';
        $menu->url = 'menu';
        $menu->parent_route = $sys_id;
        $menu->save();
        $menu->roles()->attach($admin);

        $menu = new Route();
        $menu->route_name = 'Add Menu Item';
        $menu->url = 'add-menu';
        $menu->parent_route = $sys_id;
        $menu->save();
        $menu->roles()->attach($admin);

        $menu = new Route();
        $menu->route_name = 'Arrange Menu';
        $menu->url = 'arrange-menu';
        $menu->parent_route = $sys_id;
        $menu->save();
        $menu->roles()->attach($admin);

        $menu = new Route();
        $menu->route_name = 'Get Menu Item';
        $menu->url = 'get-menu/{id}';
        $menu->parent_route = $sys_id;
        $menu->save();
        $menu->roles()->attach($admin);

        $menu = new Route();
        $menu->route_name = 'Edit Menu Item';
        $menu->url = 'edit-menu';
        $menu->parent_route = $sys_id;
        $menu->save();
        $menu->roles()->attach($admin);

        $menu = new Route();
        $menu->route_name = 'Delete Menu Item';
        $menu->url = 'delete-menu';
        $menu->parent_route = $sys_id;
        $menu->save();
        $menu->roles()->attach($admin);

        $menu = new Route();
        $menu->route_name = 'System Actions';
        $menu->url = 'sys-actions';
        $menu->parent_route = $sys_id;
        $menu->save();
        $menu->roles()->attach($admin);

        $menu = new Route();
        $menu->route_name = 'Load System Actions';
        $menu->url = 'load-action';
        $menu->parent_route = $sys_id;
        $menu->save();
        $menu->roles()->attach($admin);

        $menu = new Route();
        $menu->route_name = 'Add System Actions';
        $menu->url = 'add-action';
        $menu->parent_route = $sys_id;
        $menu->save();
        $menu->roles()->attach($admin);

        $menu = new Route();
        $menu->route_name = 'Update System Actions';
        $menu->url = 'update-action';
        $menu->parent_route = $sys_id;
        $menu->save();
        $menu->roles()->attach($admin);

        $menu = new Route();
        $menu->route_name = 'Delete System Actions';
        $menu->url = 'delete-action';
        $menu->parent_route = $sys_id;
        $menu->save();
        $menu->roles()->attach($admin);

        $menu = new Route();
        $menu->route_name = 'Get Child Routes';
        $menu->url = 'get-child-routes';
        $menu->parent_route = $sys_id;
        $menu->save();
        $menu->roles()->attach($admin);

        $menu = new Route();
        $menu->route_name = 'Get Actions';
        $menu->url = 'get-action/{id}';
        $menu->parent_route = $sys_id;
        $menu->save();
        $menu->roles()->attach($admin);

        #### Sales
        $auction_sales = new Route();
        $auction_sales->route_name = 'Sales';
        $auction_sales->save();

        $bid_sales = new Route();
        $bid_sales->route_name = 'Bid Sales';
        $bid_sales->url = 'bid-sales';
        $bid_sales->parent_route = $auction_sales->id;
        $bid_sales->save();
        $bid_sales->roles()->attach($admin);

        $buy_now = new Route();
        $buy_now->route_name = 'Buy Now Purchases';
        $buy_now->url = 'bid-sales';
        $buy_now->parent_route = $auction_sales->id;
        $buy_now->save();
        $buy_now->roles()->attach($admin);

        $buy_now = new Route();
        $buy_now->route_name = 'Ordinary Purchases';
        $buy_now->url = 'ordinary-purchases';
        $buy_now->parent_route = $auction_sales->id;
        $buy_now->save();
        $buy_now->roles()->attach($admin);

        $buy_now = new Route();
        $buy_now->route_name = 'Auction Purchases';
        $buy_now->url = 'auction-purchases';
        $buy_now->parent_route = $auction_sales->id;
        $buy_now->save();
        $buy_now->roles()->attach($admin);

        #### Revenue Manager
        $rev_man = new Route();
        $rev_man->route_name = 'Revenue Manager';
        $rev_man->save();
        $rev_id = $rev_man->id;

        $rev_man = new Route();
        $rev_man->route_name = 'Revenue Channels';
        $rev_man->url = 'revenue-channels';
        $rev_man->parent_route = $rev_id;
        $rev_man->save();
        $rev_man->roles()->attach($admin);

        $rev_man = new Route();
        $rev_man->route_name = 'Add Revenue Channel';
        $rev_man->url = 'add-rev';
        $rev_man->parent_route = $rev_id;
        $rev_man->save();
        $rev_man->roles()->attach($admin);

        $rev_man = new Route();
        $rev_man->route_name = 'Get Revenue Channel';
        $rev_man->url = 'rev-data/{id}';
        $rev_man->parent_route = $rev_id;
        $rev_man->save();
        $rev_man->roles()->attach($admin);

        $rev_man = new Route();
        $rev_man->route_name = 'Update Revenue Channel';
        $rev_man->url = 'update-rev';
        $rev_man->parent_route = $rev_id;
        $rev_man->save();
        $rev_man->roles()->attach($admin);

        $rev_man = new Route();
        $rev_man->route_name = 'Delete Revenue Channel';
        $rev_man->url = 'delete-rev';
        $rev_man->parent_route = $rev_id;
        $rev_man->save();
        $rev_man->roles()->attach($admin);

        $rev_man = new Route();
        $rev_man->route_name = 'Service Channels';
        $rev_man->url = 'service-channels';
        $rev_man->parent_route = $rev_id;
        $rev_man->save();
        $rev_man->roles()->attach($admin);

        $rev_man = new Route();
        $rev_man->route_name = 'Add Service Channel';
        $rev_man->url = 'add-sc';
        $rev_man->parent_route = $rev_id;
        $rev_man->save();
        $rev_man->roles()->attach($admin);

        $rev_man = new Route();
        $rev_man->route_name = 'Get Service Channel';
        $rev_man->url = 'service-data/{id}';
        $rev_man->parent_route = $rev_id;
        $rev_man->save();
        $rev_man->roles()->attach($admin);

        $rev_man = new Route();
        $rev_man->route_name = 'Update Service Channel';
        $rev_man->url = 'update-sc';
        $rev_man->parent_route = $rev_id;
        $rev_man->save();
        $rev_man->roles()->attach($admin);

        $rev_man = new Route();
        $rev_man->route_name = 'Delete Service Channel';
        $rev_man->url = 'delete-sc';
        $rev_man->parent_route = $rev_id;
        $rev_man->save();
        $rev_man->roles()->attach($admin);

        $rev_man = new Route();
        $rev_man->route_name = 'Service Bills';
        $rev_man->url = 'service-bills';
        $rev_man->parent_route = $rev_id;
        $rev_man->save();
        $rev_man->roles()->attach($admin);
    }
}