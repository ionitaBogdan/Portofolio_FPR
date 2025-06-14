<?php

    namespace Database\Seeders;

    use App\Models\Gemba;
    use App\Models\Name;
    use Database\Factories\GembaFactory;
    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class GembaSeeder extends Seeder
    {

//        private $data=[
//            [
//                'week' => 12,
//                'location' => 'Office Building A',
//                'team_lead'=>'Jasmine Patel',
//                'status' =>'Not completed',
//                'color' => '#F2C4DE',
//            ],
//            [
//                'week' => 25,
//                'location' => 'Factory Floor B',
//                'team_lead'=>'Ethan Carter',
//                'status' =>'In progress',
//                'color' => '#71B1D9',
//            ],
//            [
//                'week' => 13,
//                'location' => 'Warehouse C',
//                'team_lead'=>'Maya Johnson',
//                'status' =>'Not completed',
//                'color' => '#B8C6D9',
//            ],
//            [
//                'week' => 30,
//                'location' => 'Retail Store D',
//                'team_lead'=>'Xavier Ramirez',
//                'status' =>'Not completed',
//                'color' => '#F2DEA2',
//            ],
//            [
//                'week' => 4,
//                'location' => 'Distribution Center E',
//                'team_lead'=>'Isabella Chang',
//                'status' =>'Not completed',
//                 'color' => '#F2CDC4',
//            ],
//            [
//                'week' => 9,
//                'location' => 'Workshop F',
//                'team_lead'=>'Jasmine Patel',
//                'status' =>'Not completed',
//                'color' => '#F2A0A0',
//            ],
//            [
//                'week' => 10,
//                'location' => 'Production Line G',
//                'team_lead'=>'Ethan Carter',
//                'status' =>'In progress',
//                'color' => '#D1EBD8',
//            ],
//            [
//                'week' =>33,
//                'location' => 'Office Space H',
//                'team_lead'=>'Maya Johnson',
//                'status' =>'Not completed',
//                'color' => '#365359',
//            ],
//            [
//                'week' => 50,
//                'location' => 'Service Center I',
//                'team_lead'=>'Xavier Ramirez',
//                'status' =>'In progress',
//                'color' => '#F2DDD0',
//            ],
//            [
//                'week' => 14,
//                'location' => 'Laboratory J',
//                'team_lead'=>'Isabella Chang',
//                'status' =>'Completed',
//                'color' => 'FF8080',
//            ],
//        ];


        public function run(): void
        {
//            //DB::table('gembas')->insert($this->data)
            Gemba::factory(30)->create();
            //Gemba::factory(30)->has(Name::factory(1))->create();

        }
    }
