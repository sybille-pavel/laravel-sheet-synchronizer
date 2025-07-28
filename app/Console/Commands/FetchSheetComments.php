<?php

    namespace App\Console\Commands;

    use Illuminate\Console\Command;
    use App\Services\GoogleSheet\GoogleSheetService;

    class FetchSheetComments extends Command
    {
        protected $signature = 'sheet:fetch {count?} {--plain}';
        protected $description = 'Выводит ID и комментарии из Google Таблицы';

        public function handle(GoogleSheetService $sheet): void
        {
            $rows = $sheet->read();

            if (count($rows) <= 1) {
                $this->warn('Нет данных.');
                return;
            }

            $count = $this->argument('count') ?? count($rows) - 1;

            // Прогрессбар добавлен согласно ТЗ, в реальных условиях был бы не нужен
            $plain = $this->option('plain');

            if (!$plain) {
                $this->info("Получаем комментарии из таблицы. Всего строк: $count");
                $bar = $this->output->createProgressBar($count);
                $bar->start();
            }


            $output = [];

            foreach (array_slice($rows, 1, $count) as $row) {
                $id = $row[0] ?? null;
                $comment = $row[3] ?? '';
                $output[] = "ID: $id | Комментарий: $comment";
                if (!$plain) {
                    $bar->advance();
                }
            }

            if (!$plain) {
                $bar->finish();
                $this->newLine(2);
            }

            $this->newLine(2);

            foreach ($output as $line) {
                $this->line($line);
            }
        }
    }
