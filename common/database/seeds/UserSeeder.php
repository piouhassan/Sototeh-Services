<?php


use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{

    public function run()
    {
        $data = [];
        $faker = \Faker\Factory::create('fr_FR');
        for ($i = 0; $i  < 12 ; ++$i){
            $date =  $faker->unixTime('now');
            $data[] = [
                'name'  =>  $faker->name,
                'email' => $faker->email,
                'created_at' => date('Y-m-d H:i:s', $date),
                'updated_at'  => date('Y-m-d H:i:s' , $date)

            ];
        }

        $this->table('users')
            ->insert($data)
            ->save();
    }
}
