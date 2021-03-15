<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\Models\User;
        $administrator -> username="Administrator";
        $administrator -> name="Site Administrator";
        $administrator -> email="administrator@tokoberkah.test";
        $administrator -> roles=json_encode(["ADMIN"]);
        $administrator -> password = \Hash::make("tokoberkah");
        $administrator -> avatar ="saat-ini-tidak-ada-file.png";
        $administrator -> address ="Turus, Gurah, Kediri";
        
        $administrator->save();
        $this->command->info("User Admin berhasil diinsert");
    }

        /**
            *Kode di atas merupakan file seeder untuk menginsert data baru ke tabel users. Data tersebut merupakan
            *data user administrator yang akan kita gunakan untuk login ke aplikasi. Pertama kita memanfaatkan model
            *User dengan membuat instance baru new \App\Models\User sebagai variabel $administrator. Lalu
            *kita tambahkan properti-properti yang user admin tersebut meliputi username sampe password. Untuk
            *mengisi field roles kita gunakan PHP native function json_encode, kenapa? karena kita ingin menyimpan
            *tipe array ke dalam database sebagai string / teks, ingat field roles di desain database kita bertipe teks untuk
            *menyimpan array roles. Artinya setiap user nantinya bisa memiliki beberapa role baik ADMIN, STAFF atau
            *CUSTOMER secara bersamaan dalam array
            
        */
}
