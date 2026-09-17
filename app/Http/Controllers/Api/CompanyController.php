<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Repositories\Eloquent\CompanyRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    protected CompanyRepository $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function index(): JsonResponse
    {
        $companies = $this->companyRepository->all();
        return response()->json([
            'success' => true,
            'data' => CompanyResource::collection($companies)
        ]);
    }

    public function show(string $slug): JsonResponse
    {
        $company = $this->companyRepository->findBySlug($slug);

        if (!$company) {
            // Try fetching by ID for admin edit
            $company = Company::where('id', $slug)->with('seo')->first();
            if (!$company) {
                return response()->json([
                    'success' => false,
                    'message' => 'Company venture not found.'
                ], 404);
            }
        }

        return response()->json([
            'success' => true,
            'data' => new CompanyResource($company)
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'logo' => 'nullable|string',
            'description' => 'required|string',
            'content' => 'required|string',
            'website_url' => 'nullable|string',
            'services' => 'nullable|array',
            'locations' => 'nullable|array',
            'is_active' => 'required|boolean',
            'order' => 'nullable|integer',
            'seo' => 'nullable|array',
            'story' => 'nullable|string',
            'mission' => 'nullable|string',
            'technologies' => 'nullable|array',
            'industries' => 'nullable|array',
            'faqs' => 'nullable|array',
            'related_services' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();
        $validated['slug'] = Str::slug($validated['name']);

        if (Company::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] .= '-' . rand(10, 99);
        }

        $company = Company::create($validated);

        if (!empty($validated['seo'])) {
            $company->seo()->create([
                'meta_title' => $validated['seo']['meta_title'] ?? $company->name,
                'meta_description' => $validated['seo']['meta_description'] ?? $company->description,
                'keywords' => $validated['seo']['keywords'] ?? '',
                'canonical_url' => $validated['seo']['canonical_url'] ?? '',
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Company venture created successfully.',
            'data' => new CompanyResource($company->load('seo'))
        ], 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $company = Company::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'logo' => 'nullable|string',
            'description' => 'required|string',
            'content' => 'required|string',
            'website_url' => 'nullable|string',
            'services' => 'nullable|array',
            'locations' => 'nullable|array',
            'is_active' => 'required|boolean',
            'order' => 'nullable|integer',
            'seo' => 'nullable|array',
            'story' => 'nullable|string',
            'mission' => 'nullable|string',
            'technologies' => 'nullable|array',
            'industries' => 'nullable|array',
            'faqs' => 'nullable|array',
            'related_services' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();
        $validated['slug'] = Str::slug($validated['name']);

        if (Company::where('slug', $validated['slug'])->where('id', '!=', $company->id)->exists()) {
            $validated['slug'] .= '-' . rand(10, 99);
        }

        $company->update($validated);

        if (!empty($validated['seo'])) {
            $company->seo()->updateOrCreate(
                ['model_type' => Company::class, 'model_id' => $company->id],
                [
                    'meta_title' => $validated['seo']['meta_title'] ?? $company->name,
                    'meta_description' => $validated['seo']['meta_description'] ?? $company->description,
                    'keywords' => $validated['seo']['keywords'] ?? '',
                    'canonical_url' => $validated['seo']['canonical_url'] ?? '',
                ]
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Company venture updated successfully.',
            'data' => new CompanyResource($company->load('seo'))
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        $company = Company::where('id', $id)->orWhere('slug', $id)->first();
        if (!$company) {
            return response()->json([
                'success' => false,
                'message' => 'Company venture not found.'
            ], 404);
        }

        $company->delete();
        \Illuminate\Support\Facades\Cache::flush();

        return response()->json([
            'success' => true,
            'message' => 'Company venture deleted successfully.'
        ]);
    }
}
