<?php

    namespace App\Services;

    use App\Enums\RecordStatus;
    use App\Models\Record;

    class RecordGeneratorService
    {
        public function handle(int $count = 1000)
        {
            $now = now();
            $rows = [];

            foreach (range(1, $count) as $i) {
                $rows[] = [
                    'content' => "Random line #$i",
                    'status' => $i % 2 === 0 ? RecordStatus::Allowed->value : RecordStatus::Prohibited->value,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            Record::insert($rows);
        }
    }
