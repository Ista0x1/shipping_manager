<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\customers;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        $customers = [
            [
                'code' => 300,
                'name' => 'Faycel',
                'phone' => '0',
                'adress' => 'Alger',
            ],
            [
                'code' => 301,
                'name' => 'Ibrahim Souri',
                'phone' => '',
                'adress' => 'Alger',
            ],
            [
                'code' => 302,
                'name' => 'Adel Adoui',
                'phone' => '',
                'adress' => 'Alger',
            ],
            [
                'code' => 303,
                'name' => 'Abd Elnour',
                'phone' => '',
                'adress' => 'Alger',
            ],
            [
                'code' => 304,
                'name' => 'Khalfoun',
                'phone' => '',
                'adress' => 'Alger',
            ],
            [
                'code' => 305,
                'name' => 'f',
                'phone' => '',
                'adress' => 'Alger',
            ],
            [
                'code' => 306,
                'name' => 'Ami Moh',
                'phone' => '0542 19 20 62',
                'adress' => 'Alger',
            ],
            [
                'code' => 307,
                'name' => 'Kara Hind',
                'phone' => '0672 93 58 31',
                'adress' => 'Sidi Bel Abesse',
            ],
            [
                'code' => 308,
                'name' => 'Ghribi Hsen',
                'phone' => '0656 22 12 43',
                'adress' => 'Sidi Bel Abesse',
            ],
            [
                'code' => 309,
                'name' => 'Bibit Nasser',
                'phone' => '',
                'adress' => 'Alger',
            ],
            [
                'code' => 310,
                'name' => 'Ihssen',
                'phone' => '',
                'adress' => 'Alger',
            ],
            [
                'code' => 311,
                'name' => 'Boidi Mansour',
                'phone' => '',
                'adress' => 'Oran',
            ],
            [
                'code' => 312,
                'name' => 'Hicham Allam',
                'phone' => '',
                'adress' => 'Constantine',
            ],
            [
                'code' => 313,
                'name' => 'Natah Amin',
                'phone' => '00213 777 16 62 86',
                'adress' => 'Msila',
            ],
            [
                'code' => 314,
                'name' => 'Nahi Mohamed',
                'phone' => '00213 782 01 03 39',
                'adress' => 'Alger',
            ],
            [
                'code' => 315,
                'name' => 'Belkhir Sohaib',
                'phone' => '0090 552 486 52 20',
                'adress' => 'Msila',
            ],
            [
                'code' => 316,
                'name' => 'Riyad Kharbiyan',
                'phone' => '00213 559 39 60 66',
                    'adress' => 'Alger',
            ],
            [
                'code' => 317,
                'name' => 'Salim',
                'phone' => '00213 557 08 61 82',
                'adress' => 'Msila',
            ],
            [
                'code' => 318,
                'name' => 'Hakim Hamadi',
                'phone' => '0555 59 23 85',
                'adress' => 'Alger',
            ],
            [
                'code' => 319,
                'name' => 'Aymen Soiadia',
                'phone' => '0668 67 71 72',
                'adress' => 'Msila',
            ],
            [
                'code' => 320,
                'name' => 'Nasser Hamyani',
                'phone' => '0550 10 50 95',
                'adress' => 'Msila',
            ],
            [
                'code' => 321,
                'name' => 'Halim Yatou',
                'phone' => '00213 770 91 97 69',
                'adress' => 'Alger',
            ],
            [
                'code' => 322,
                'name' => 'Mahmud Ayet Waarab',
                'phone' => '00213 551 18 39 03',
                'adress' => 'Alger',
            ],
            [
                'code' => 323,
                'name' => 'Zahaf Abd Elkader',
                'phone' => '00213 657 52 14 82',
                'adress' => 'Oran Naama',
            ],
            [
                'code' => 324,
                'name' => 'Imad Ouchich',
                'phone' => '0799 77 68 13',
                'adress' => 'Bejaia',
            ],
            [
                'code' => 325,
                'name' => 'Ouamer Mohamed',
                'phone' => '00213 542 31 24 94',
                'adress' => 'Alger',
            ],
            [
                'code' => 326,
                'name' => 'Zenasni Badiaa',
                'phone' => '0782361630-0779226301',
                'adress' => 'Beni Saf Ain timouchent',
            ],
            [
                'code' => 327,
                'name' => 'Bousaa Haroun',
                'phone' => '00213 552 31 37 74',
                'adress' => 'Jijel',
            ],
            [
                'code' => 328,
                'name' => 'Miloudi Abdeljalil',
                'phone' => '00213 771 78 60 03',
                'adress' => 'Oran Saida',
            ],
            [
                'code' => 329,
                'name' => 'Ouaded Bouzir',
                'phone' => '213 542 82 79 51',
                'adress' => 'Oran',
            ],
            [
                'code' => 330,
                'name' => 'Samir Azrar',
                'phone' => '213 556 71 78 41',
                'adress' => 'Alger',
            ],

        ];

        foreach ($customers as $customer) {
            customers::create($customer);
        }
    }
}
