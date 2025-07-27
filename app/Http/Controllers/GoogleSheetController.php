<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\GoogleSheetStoreRequest;
    use App\Models\GoogleSheetConfig;
    use App\Services\GoogleSheet\StoreGoogleSheetConfig;
    use Illuminate\Http\JsonResponse;

    class GoogleSheetController
    {
        public function store(GoogleSheetStoreRequest $request, StoreGoogleSheetConfig $service): JsonResponse
        {
            $config = $service->handle($request->sheet_url);
            return response()->json($config);
        }
    }
