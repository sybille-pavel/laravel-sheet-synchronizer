<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\GoogleSheetStoreRequest;
    use App\Models\GoogleSheetConfig;
    use App\Services\GoogleSheet\StoreGoogleSheetConfig;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;

    class GoogleSheetController
    {
        public function index(): JsonResponse
        {
            return response()->json(GoogleSheetConfig::getActive());
        }

        public function store(GoogleSheetStoreRequest $request, StoreGoogleSheetConfig $service): JsonResponse
        {
            $config = $service->handle($request->sheet_url);
            return response()->json($config);
        }
    }
