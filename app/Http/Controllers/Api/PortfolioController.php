<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PortfolioProjectResource;
use App\Http\Resources\CaseStudyResource;
use App\Models\PortfolioProject;
use App\Models\CaseStudy;
use App\Repositories\Eloquent\PortfolioRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    protected PortfolioRepository $portfolioRepository;

    public function __construct(PortfolioRepository $portfolioRepository)
    {
        $this->portfolioRepository = $portfolioRepository;
    }

    public function index(): JsonResponse
    {
        $projects = $this->portfolioRepository->all();
        return response()->json([
            'success' => true,
            'data' => PortfolioProjectResource::collection($projects)
        ]);
    }

    public function featured(): JsonResponse
    {
        $projects = $this->portfolioRepository->getFeatured();
        return response()->json([
            'success' => true,
            'data' => PortfolioProjectResource::collection($projects)
        ]);
    }

    public function show(string $slug): JsonResponse
    {
        $project = $this->portfolioRepository->findBySlug($slug);

        if (!$project) {
            // Try fetching by ID for admin edit
            $project = PortfolioProject::where('id', $slug)->with(['caseStudy', 'seo'])->first();
            if (!$project) {
                return response()->json([
                    'success' => false,
                    'message' => 'Project not found.'
                ], 404);
            }
        }

        return response()->json([
            'success' => true,
            'data' => new PortfolioProjectResource($project)
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'summary' => 'nullable|string',
            'content' => 'nullable|string',
            'website_url' => 'nullable|string',
            'technologies' => 'nullable|array',
            'business_outcomes' => 'nullable|array',
            'results_summary' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'order' => 'nullable|integer',
            'seo' => 'nullable|array',
            'case_study' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();
        $validated['slug'] = Str::slug($validated['title']);
        $validated['client_name'] = $validated['client_name'] ?? 'Venture Case Study';
        $validated['summary'] = $validated['summary'] ?? ($validated['title'] . ' case study and system architecture.');
        $validated['content'] = $validated['content'] ?? ($validated['summary'] ?? '');
        $validated['results_summary'] = $validated['results_summary'] ?? 'Delivered on time and within scope.';
        $validated['technologies'] = $validated['technologies'] ?? [];
        $validated['business_outcomes'] = $validated['business_outcomes'] ?? [];
        $validated['is_featured'] = isset($validated['is_featured']) ? (bool)$validated['is_featured'] : true;
        $validated['order'] = $validated['order'] ?? 0;

        if (empty($validated['website_url'])) {
            $validated['website_url'] = null;
        }

        if (PortfolioProject::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] .= '-' . rand(10, 99);
        }

        $project = PortfolioProject::create($validated);

        if (!empty($validated['seo'])) {
            $project->seo()->create([
                'meta_title' => $validated['seo']['meta_title'] ?? $project->title,
                'meta_description' => $validated['seo']['meta_description'] ?? $project->summary,
                'keywords' => $validated['seo']['keywords'] ?? '',
                'canonical_url' => $validated['seo']['canonical_url'] ?? '',
            ]);
        }

        CaseStudy::create([
            'portfolio_project_id' => $project->id,
            'title' => 'Case Study: ' . $project->title,
            'slug' => 'case-study-' . $project->slug,
            'problem' => $validated['case_study']['problem'] ?? $project->summary,
            'solution' => $validated['case_study']['solution'] ?? $project->content,
            'technology' => $project->technologies,
            'approach' => $validated['case_study']['approach'] ?? '',
            'timeline_duration' => $validated['case_study']['timeline_duration'] ?? '3 Months',
            'challenges' => $validated['case_study']['challenges'] ?? '',
            'results' => $validated['case_study']['results'] ?? $project->results_summary,
            'roi_percentage' => $validated['case_study']['roi_percentage'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Portfolio project created successfully.',
            'data' => new PortfolioProjectResource($project->load(['caseStudy', 'seo']))
        ], 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $project = PortfolioProject::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'summary' => 'nullable|string',
            'content' => 'nullable|string',
            'website_url' => 'nullable|string',
            'technologies' => 'nullable|array',
            'business_outcomes' => 'nullable|array',
            'results_summary' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'order' => 'nullable|integer',
            'seo' => 'nullable|array',
            'case_study' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();
        if (isset($validated['title'])) {
            $validated['slug'] = Str::slug($validated['title']);
            if (PortfolioProject::where('slug', $validated['slug'])->where('id', '!=', $project->id)->exists()) {
                $validated['slug'] .= '-' . rand(10, 99);
            }
        }

        if (array_key_exists('website_url', $validated) && empty($validated['website_url'])) {
            $validated['website_url'] = null;
        }

        $project->update($validated);

        if (!empty($validated['seo'])) {
            $project->seo()->updateOrCreate(
                ['model_type' => PortfolioProject::class, 'model_id' => $project->id],
                [
                    'meta_title' => $validated['seo']['meta_title'] ?? $project->title,
                    'meta_description' => $validated['seo']['meta_description'] ?? $project->summary,
                    'keywords' => $validated['seo']['keywords'] ?? '',
                    'canonical_url' => $validated['seo']['canonical_url'] ?? '',
                ]
            );
        }

        CaseStudy::updateOrCreate(
            ['portfolio_project_id' => $project->id],
            [
                'title' => 'Case Study: ' . $project->title,
                'slug' => 'case-study-' . $project->slug,
                'problem' => $validated['case_study']['problem'] ?? $project->summary,
                'solution' => $validated['case_study']['solution'] ?? $project->content,
                'technology' => $project->technologies,
                'approach' => $validated['case_study']['approach'] ?? '',
                'timeline_duration' => $validated['case_study']['timeline_duration'] ?? '3 Months',
                'challenges' => $validated['case_study']['challenges'] ?? '',
                'results' => $validated['case_study']['results'] ?? $project->results_summary,
                'roi_percentage' => $validated['case_study']['roi_percentage'] ?? null,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Portfolio project updated successfully.',
            'data' => new PortfolioProjectResource($project->load(['caseStudy', 'seo']))
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        $project = PortfolioProject::findOrFail($id);
        $project->delete();

        return response()->json([
            'success' => true,
            'message' => 'Project deleted successfully.'
        ]);
    }

    public function caseStudies(): JsonResponse
    {
        $caseStudies = $this->portfolioRepository->getCaseStudies();
        return response()->json([
            'success' => true,
            'data' => CaseStudyResource::collection($caseStudies)
        ]);
    }

    public function showCaseStudy(string $slug): JsonResponse
    {
        $caseStudy = $this->portfolioRepository->findCaseStudyBySlug($slug);

        if (!$caseStudy) {
            return response()->json([
                'success' => false,
                'message' => 'Case study not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new CaseStudyResource($caseStudy)
        ]);
    }
}
