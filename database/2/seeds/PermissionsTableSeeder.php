<?php
namespace database\seeders;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'category_create',
            ],
            [
                'id'    => '18',
                'title' => 'category_edit',
            ],
            [
                'id'    => '19',
                'title' => 'category_show',
            ],
            [
                'id'    => '20',
                'title' => 'category_delete',
            ],
            [
                'id'    => '21',
                'title' => 'category_access',
            ],
            [
                'id'    => '22',
                'title' => 'meal_create',
            ],
            [
                'id'    => '23',
                'title' => 'meal_edit',
            ],
            [
                'id'    => '24',
                'title' => 'meal_show',
            ],
            [
                'id'    => '25',
                'title' => 'meal_delete',
            ],
            [
                'id'    => '26',
                'title' => 'meal_access',
            ],
            [
                'id'    => '27',
                'title' => 'profile_password_edit',
            ],
            [
                'id'    => '28',
                'title' => 'country_access',
            ],
            [
                'id'    => '29',
                'title' => 'country_edit',
            ],
            [
                'id'    => '30',
                'title' => 'country_delete',
            ],
            [
                'id'    => '31',
                'title' => 'country_view',
            ],
            [
                'id'    => '32',
                'title' => 'country_create',
            ],

            [
                'id'    => '33',
                'title' => 'customer_access',
            ],
            [
                'id'    => '34',
                'title' => 'customer_create',
            ],
            [
                'id'    => '35',
                'title' => 'customer_edit',
            ],
             
            [
                'id'    => '36',
                'title' => 'customer_view',
            ],
            [
                'id'    => '37',
                'title' => 'customer_delete',
            ],
            [
                'id'    => '38',
                'title' => 'room_access',
            ],
            [
                'id'    => '39',
                'title' => 'room_create',
            ],
            [
                'id'    => '40',
                'title' => 'room_edit',
            ],
            [
                'id'    => '41',
                'title' => 'room_view',
            ],
            [
                'id'    => '42',
                'title' => 'room_delete',
            ],
            [
                'id'    => '43',
                'title' => 'booking_access',
            ],
            [
                'id'    => '44',
                'title' => 'booking_create',
            ],
            [
                'id'    => '45',
                'title' => 'booking_edit',
            ],
            [
                'id'    => '46',
                'title' => 'booking_view',
            ],
            [
                'id'    => '47',
                'title' => 'booking_delete',
            ],
            [
                'id'    => '46',
                'title' => 'find_room_access',
            ],

        ];

        Permission::insert($permissions);
    }
}
