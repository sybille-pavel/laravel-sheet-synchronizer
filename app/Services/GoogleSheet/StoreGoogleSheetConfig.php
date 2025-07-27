<?php

    namespace App\Services\GoogleSheet;

    use App\Models\GoogleSheetConfig;

    class StoreGoogleSheetConfig
    {
        public function handle(string $sheetUrl): GoogleSheetConfig
        {
            $sheetId = $this->extractSheetId($sheetUrl);

            return GoogleSheetConfig::updateOrCreate(
                ['id' => 1],
                [
                    'sheet_url' => $sheetUrl,
                    'sheet_id' => $sheetId,
                    'sheet_name' => 'Sheet1',
                ]
            );
        }

        protected function extractSheetId(string $url): string
        {
            if (preg_match('/\/d\/([a-zA-Z0-9-_]+)/', $url, $matches)) {
                return $matches[1];
            }

            throw new \InvalidArgumentException('Invalid Google Sheet URL.');
        }
    }

