<?php
return [
    'token_path' => env('GOOGLE_APPLICATION_CREDENTIALS', 'storage/app/google/google-sheet.json'),
    'sheet_name' => env('GOOGLE_SHEET_TAB_NAME', 'Лист1')
];
