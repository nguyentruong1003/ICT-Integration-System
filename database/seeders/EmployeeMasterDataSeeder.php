<?php

namespace Database\Seeders;

use App\Models\MasterData;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class EmployeeMasterDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->position();
        $this->ethnic();
        $this->religion();
        $this->nation();
    }

    protected function uniqueInsertMany($data)
    {
        foreach ($data as $item) {
            MasterData::query()->firstOrCreate(
                [
                    'type' => $item['type'],
                    'key' => $item['key'] ?? '',
                    'value' => $item['value'] ?? '',
                    'order' => $item['order'] ?? '',
                ]
            );
        }
    }

    public function position()
    {
        $data = require_once('database/raw/PositionData.php');
        $this->uniqueInsertMany($data);
        echo "Seeded: Positions" . PHP_EOL;
    }

    public function ethnic()
    {
        $data = require_once('Database/raw/EthnicData.php');
        $this->uniqueInsertMany($data);
        echo "Seeded: Ethnic" . PHP_EOL;
    }

    public function religion()
    {
        $data = require_once('Database/raw/ReligionData.php');
        $this->uniqueInsertMany($data);
        echo "Seeded: Religion" . PHP_EOL;
    }

    public function nation()
    {
        $data = require_once('Database/raw/NationData.php');
        $this->uniqueInsertMany($data);
        echo "Seeded: Nations" . PHP_EOL;
    }

    // public function qualification()
    // {
    //     $data = require_once('Database/raw/QualificationData.php');
    //     $this->uniqueInsertMany($data);
    //     echo "Seeded: Qualifications" . PHP_EOL;
    // }

    // public function rank()
    // {
    //     $data = require_once('Database/raw/RankData.php');
    //     $this->uniqueInsertMany($data);
    //     echo "Seeded: Ranks" . PHP_EOL;
    // }

    // public function bank()
    // {
    //     $data = require_once('Database/raw/BankData.php');
    //     $this->uniqueInsertMany($data);
    //     echo "Seeded: Banks" . PHP_EOL;
    // }

    // public function contractType()
    // {
    //     $data = require_once('Database/raw/ContractTypeData.php');
    //     $this->uniqueInsertMany($data);
    //     echo "Seeded: ContractType" . PHP_EOL;
    // }

    // public function contractPeriod()
    // {
    //     $data = require_once('Database/raw/ContractPeriodData.php');
    //     $this->uniqueInsertMany($data);
    //     echo "Seeded: ContractPeriod" . PHP_EOL;
    // }

    // public function contractTypeOfwork()
    // {
    //     $data = require_once('Database/raw/ContractTypeOfWorkData.php');
    //     $this->uniqueInsertMany($data);
    //     echo "Seeded: ContractTypeOfWork" . PHP_EOL;
    // }
}
