<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FaqResource;
use App\Models\Faq;
use App\Repositories\Eloquent\FaqRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    protected FaqRepository $faqRepository;

    public function __construct(FaqRepository $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    public function index(Request $request): JsonResponse
    {
        if ($request->has('category')) {
            $faqs = $this->faqRepository->getByCategory($request->get('category'));
        } elseif ($request->has('page')) {
            $faqs = $this->faqRepository->getByPage($request->get('page'));
        } else {
            $faqs = $this->faqRepository->all();
        }

        return response()->json([
            'success' => true,
            'data' => FaqResource::collection($faqs)
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category_key' => 'required|string|max:100',
            'page_slug' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $faq = Faq::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'FAQ created successfully.',
            'data' => new FaqResource($faq)
        ], 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $faq = Faq::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category_key' => 'required|string|max:100',
            'page_slug' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $faq->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'FAQ updated successfully.',
            'data' => new FaqResource($faq)
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return response()->json([
            'success' => true,
            'message' => 'FAQ deleted successfully.'
        ]);
    }
}
