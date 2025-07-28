<?php

    namespace App\Console\Commands;

    use App\Models\Record;
    use App\Services\GoogleSheet\GoogleSheetService;
    use Illuminate\Console\Command;

    class SyncToSheet extends Command
    {
        protected $signature = 'sheet:sync';

        public function handle(GoogleSheetService $sheet): void
        {
            $comments = $this->extractComments($sheet->read());
            $records = Record::allowed()->get();

            $rows = $this->buildRows($records, $comments);

            $sheet->clear();
            $sheet->write($rows);

            $this->info("Синхронизировано: {$records->count()} записей.");
        }

        protected function extractComments(array $sheetData): array
        {
            return collect($sheetData)
                ->skip(1)
                ->mapWithKeys(function ($row) {
                    if (isset($row[0])) {
                        $id = (int) $row[0];
                        $comment = $row[3] ?? '';
                        return [$id => $comment];
                    }
                    return [];
                })
                ->all();
        }

        protected function buildRows($records, array $comments): array
        {
            $rows = [['ID', 'Content', 'Status', 'Комментарий']];

            foreach ($records as $record) {
                $rows[] = [
                    $record->id,
                    $record->content,
                    $record->status,
                    $comments[$record->id] ?? '',
                ];
            }

            return $rows;
        }
    }
