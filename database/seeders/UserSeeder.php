<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
            DB::table('users')->insert([
                'name'=>'Trần Đình Nghĩa',
                'email'=>'trandinhnghia555@gmail.com',
                'password' => bcrypt('nghiadh1'),
                'phone' => '0904373670',
                'address' => 'Từ Sơn-Bắc Ninh',
                'role' => '2',
                'gender' => '1',
                'created_at' => Carbon::now(),
            ]);

            DB::table('userinfor')->truncate();
                DB::table('userinfor')->insert([
                    'user_id' => '1',
                ]);

            // DB::table('tbl_statistical')->truncate();

            DB::table('products')->truncate();
            DB::table('categories')->truncate();
            // DB::table('roles')->truncate();
            // DB::table('permissions')->truncate();

            $permissions = [
                [
                    'name' => 'add product',
                    'description' => 'Bạn có quyền tạo mới sản phẩm',
                    'gaurd_name' => 'web',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'name' => 'edit product',
                    'description' => 'Bạn có quyền chỉnh sửa sản phẩm của bạn',
                    'gaurd_name' => 'web',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'name' => 'delete product',
                    'description' => 'Bạn có quyền xóa sản phẩm của bạn',
                    'gaurd_name' => 'web',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'name' => 'add category',
                    'description' => 'Bạn có quyền tạo mới danh mục',
                    'gaurd_name' => 'web',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'name' => 'edit category',
                    'description' => 'Bạn có quyền chỉnh sửa danh mục của bạn',
                    'gaurd_name' => 'web',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'name' => 'delete category',
                    'description' => 'Bạn có quyền xóa danh mục của bạn',
                    'gaurd_name' => 'web',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'name' => 'add user',
                    'description' => 'Bạn có quyền tạo mới người dùng',
                    'gaurd_name' => 'web',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'name' => 'edit user',
                    'description' => 'Bạn có quyền chỉnh sửa người dùng',
                    'gaurd_name' => 'web',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'name' => 'delete user',
                    'description' => 'Bạn có quyền xóa người dùng',
                    'gaurd_name' => 'web',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'name' => 'lock user',
                    'description' => 'Bạn có quyền khóa tài khoản của người dùng',
                    'gaurd_name' => 'web',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'name' => 'respone user',
                    'description' => 'Bạn có quyền khôi phục người dùng',
                    'gaurd_name' => 'web',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'name' => 'seen statistical',
                    'description' => 'Bạn có quyền xem thống kê của Pages',
                    'gaurd_name' => 'web',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'name' => 'add post',
                    'description' => 'Bạn có quyền tạo mới bài viết',
                    'gaurd_name' => 'web',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'name' => 'edit post',
                    'description' => 'Bạn có quyền chỉnh sửa bài viết',
                    'gaurd_name' => 'web',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'name' => 'delte post',
                    'description' => 'Bạn có quyền xóa bài viết',
                    'gaurd_name' => 'web',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                
            ];

            foreach($permissions as $val)
            {
                Permission::insert($val);
            }
    }
}
