<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\RecordRequest;
    use App\Http\Resources\RecordResource;
    use App\Models\Record;
    use App\Services\RecordGeneratorService;
    use Illuminate\Http\JsonResponse;

    class RecordController extends Controller
    {
        public function index(): JsonResponse
        {
            return response()->json(
                RecordResource::collection(Record::all())
            );
        }

        public function store(RecordRequest $request): JsonResponse
        {
            $record = Record::create($request->validated());
            return response()->json(new RecordResource($record), 201);
        }

        public function update(RecordRequest $request, Record $record): JsonResponse
        {
            $record->update($request->validated());
            return response()->json(new RecordResource($record));
        }

        public function destroy(Record $record): \Illuminate\Http\Response
        {
            $record->delete();
            return response()->noContent();
        }

        public function generate(RecordGeneratorService $service): JsonResponse
        {
            $service->handle();
            return response()->json(['message' => 'Generated 1000 rows']);
        }

        public function truncate(): JsonResponse
        {
            Record::truncate();
            return response()->json(['message' => 'Table truncated']);
        }
    }
