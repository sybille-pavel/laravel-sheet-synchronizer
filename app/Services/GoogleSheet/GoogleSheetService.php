<?php

    namespace App\Services\GoogleSheet;

    use App\Models\GoogleSheetConfig;
    use Google_Client;
    use Google_Service_Sheets;
    use Google_Service_Sheets_ClearValuesRequest;
    use Google_Service_Sheets_ValueRange;

    class GoogleSheetService
    {
        protected Google_Service_Sheets $service;
        protected string $spreadsheetId;
        protected string $sheetName;

        public function __construct()
        {
            $client = new Google_Client();
            $client->setAuthConfig(base_path(config('google.token_path')));
            $client->addScope(Google_Service_Sheets::SPREADSHEETS);

            $this->service = new Google_Service_Sheets($client);
            $this->spreadsheetId = GoogleSheetConfig::getActive()->sheet_id;
            $this->sheetName = config('google.sheet_name');
        }

        public function write(array $rows): void
        {
            $range = "{$this->sheetName}!A1";
            $body = new Google_Service_Sheets_ValueRange(['values' => $rows]);

            $this->service->spreadsheets_values->update(
                $this->spreadsheetId,
                $range,
                $body,
                ['valueInputOption' => 'RAW']
            );
        }


        public function read(): array
        {
            $range = "{$this->sheetName}!A1:Z";
            return $this->service->spreadsheets_values
                ->get($this->spreadsheetId, $range)
                ->getValues() ?? [];
        }

        public function clear(): void
        {
            $range = "{$this->sheetName}!A1:Z";
            $request = new Google_Service_Sheets_ClearValuesRequest();
            $this->service->spreadsheets_values->clear($this->spreadsheetId, $range, $request);
        }
    }
