<?php

use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
         \App\Models\Menu::create(['name' => 'Dashboard' , 'url' => '/dashboard' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);

         \App\Models\Menu::create(['name' => 'Interaksi' , 'url' => '/clinic/interaksi' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Lead' , 'url' => '/clinic/lead' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Follow Up' , 'url' => '/clinic/followup' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Reservasi' , 'url' => '/clinic/reservation' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Closing' , 'url' => '/clinic/closing' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);

         \App\Models\Menu::create(['name' => 'Data Pasien' , 'url' => '/#' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Data Ramuan' , 'url' => '/#' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Kwitansi Bonus' , 'url' => '/#' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Closing klinik' , 'url' => '/#' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);

         \App\Models\Menu::create(['name' => 'Interaksi' , 'url' => '/product/interaksi' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Lead' , 'url' => '/product/lead' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Follow Up' , 'url' => '/product/followup' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Transaksi' , 'url' => '/product/transaksi' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Closing' , 'url' => '/product/closing' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);

         \App\Models\Menu::create(['name' => 'Bank Masuk' , 'url' => '/#' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Bank Keluar' , 'url' => '/#' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Omset Produk' , 'url' => '/#' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Kwitansi Bonus' , 'url' => '/#' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Closing Produk' , 'url' => '/#' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Pengiriman Barang' , 'url' => '/#' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Barang Return' , 'url' => '/#' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Barang Masuk' , 'url' => '/#' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Barang Keluar' , 'url' => '/#' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Stock Opname' , 'url' => '/#' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Stock Produk' , 'url' => '/#' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);

         \App\Models\Menu::create(['name' => 'Advertise' , 'url' => '/master/ads' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Bank' , 'url' => '/master/bank' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'City' , 'url' => '/master/city' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Clinic' , 'url' => '/master/clinic' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Company' , 'url' => '/master/company' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Confirmation' , 'url' => '/master/confirmation' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Courier' , 'url' => '/master/courier' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Gender' , 'url' => '/master/gender' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Interaction' , 'url' => '/master/interaction' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Item Price' , 'url' => '/master/itemprice' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Market' , 'url' => '/master/market' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Payment Type' , 'url' => '/master/paymenttype' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Periode' , 'url' => '/master/periode' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Product' , 'url' => '/master/product' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Shift Work' , 'url' => '/master/shiftwork' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);

         \App\Models\Menu::create(['name' => 'User Management' , 'url' => '/management/user' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Role & Permission' , 'url' => '/management/role' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Menu Auth' , 'url' => '/management/menu' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'User Login History' , 'url' => '/management/login-history' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);
         \App\Models\Menu::create(['name' => 'Log Out' , 'url' => '/logout' , 'parent_id'=>0 , 'description'=>'SYSTEM MANAGEMENT' , 'icon'=>1]);

         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>1,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>2,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>3,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>4,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>5,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>6,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>7,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>8,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>9,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>10,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>11,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>12,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>13,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>14,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>15,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>16,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>17,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>18,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>19,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>20,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>21,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>22,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>23,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>24,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>25,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>26,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>27,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>28,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>29,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>30,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>31,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>32,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>33,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>34,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>35,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>36,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>37,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>38,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>39,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>40,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>41,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>42,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>43,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>44,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>45,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);
         \App\Models\RoleAuth::create(['role_id'=>2,'menu_id'=>46,'view'=>1,'create'=>1,'update'=>1,'delete'=>1,'view'=>1]);

     }
 }
