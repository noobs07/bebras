<?php

namespace Database\Seeders;

use App\Models\Statistic;
use Illuminate\Database\Seeder;

class StatisticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'year'       => 2016,
                'si_kecil'   => null,
                'siaga'      => 198,
                'penggalang' => 387,
                'penegak'    => 968,
                'pria'       => 996,
                'wanita'     => 557,
                'sekolah'    => 125,
                'biro'       => 16,
            ],
            [
                'year'       => 2017,
                'si_kecil'   => null,
                'siaga'      => 863,
                'penggalang' => 1176,
                'penegak'    => 1675,
                'pria'       => 2118,
                'wanita'     => 1596,
                'sekolah'    => 332,
                'biro'       => 30,
            ],
            [
                'year'       => 2018,
                'si_kecil'   => null,
                'siaga'      => 1092,
                'penggalang' => 1688,
                'penegak'    => 1897,
                'pria'       => 2546,
                'wanita'     => 2131,
                'sekolah'    => 403,
                'biro'       => 42,
            ],
            [
                'year'       => 2019,
                'si_kecil'   => null,
                'siaga'      => 1384,
                'penggalang' => 2926,
                'penegak'    => 2463,
                'pria'       => null,
                'wanita'     => null,
                'sekolah'    => 453,
                'biro'       => 49,
            ],
            [
                'year'       => 2020,
                'si_kecil'   => 2543,
                'siaga'      => 3297,
                'penggalang' => 5870,
                'penegak'    => 4476,
                'pria'       => 7532,
                'wanita'     => 8654,
                'sekolah'    => 998,
                'biro'       => 50,
            ],
            [
                'year'       => 2021,
                'si_kecil'   => 3909,
                'siaga'      => 6142,
                'penggalang' => 10112,
                'penegak'    => 6667,
                'pria'       => 12976,
                'wanita'     => 13854,
                'sekolah'    => 1413,
                'biro'       => 57,
            ],
            [
                'year'       => 2022,
                'si_kecil'   => 5173,
                'siaga'      => 5943,
                'penggalang' => 9436,
                'penegak'    => 13763,
                'pria'       => 16591,
                'wanita'     => 17724,
                'sekolah'    => 1050,
                'biro'       => 44,
            ],
            [
                'year'       => 2023,
                'si_kecil'   => 5472,
                'siaga'      => 10301,
                'penggalang' => 21535,
                'penegak'    => 9092,
                'pria'       => 23003,
                'wanita'     => 23397,
                'sekolah'    => 1521,
                'biro'       => 46,
            ],
            [
                'year'       => 2024,
                'si_kecil'   => 8438,
                'siaga'      => 12706,
                'penggalang' => 24872,
                'penegak'    => 13726,
                'pria'       => 29006,
                'wanita'     => 30736,
                'sekolah'    => 1648,
                'biro'       => 45,
            ],
        ];

        foreach ($data as $row) {
            Statistic::updateOrCreate(['year' => $row['year']], $row);
        }
    }
}
