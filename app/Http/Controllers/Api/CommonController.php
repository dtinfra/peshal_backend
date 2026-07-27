<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Award;
use App\Models\Certification;
use App\Models\Event;
use App\Models\Resource;
use App\Models\SeoMetadata;
use App\Models\Blog;
use App\Models\Service;
use App\Models\Company;
use App\Models\PortfolioProject;
use App\Http\Resources\SeoMetadataResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function pageSeo(Request $request): JsonResponse
    {
        $path = $request->get('path', '/');
        $seo = SeoMetadata::where('model_type', 'Page')
            ->where('canonical_url', 'like', "%{$path}")
            ->first();

        if (!$seo) {
            // Fallback to homepage SEO
            $seo = SeoMetadata::where('model_type', 'Page')->first();
        }

        return response()->json([
            'success' => true,
            'data' => new SeoMetadataResource($seo)
        ]);
    }

    public function timeline(): JsonResponse
    {
        $experiences = \App\Models\WorkExperience::orderBy('order')->get();
        $education = \App\Models\EducationRecord::orderBy('end_year', 'desc')->get();
        $events = Event::orderBy('event_date', 'desc')->get();
        $certifications = Certification::orderBy('issue_date', 'desc')->get();
        $awards = Award::orderBy('year', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => [
                'experiences' => $experiences,
                'education' => $education,
                'events' => $events,
                'certifications' => $certifications,
                'awards' => $awards
            ]
        ]);
    }

    public function resources(): JsonResponse
    {
        $resources = Resource::where('is_active', true)->get();
        return response()->json([
            'success' => true,
            'data' => $resources
        ]);
    }

    public function stats(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'experience_years' => 10,
                'ventures_count' => Company::count(),
                'projects_count' => PortfolioProject::count(),
                'speaking_gigs' => Event::where('is_speaking', true)->count(),
                'certifications_count' => Certification::count(),
            ]
        ]);
    }

    public function search(Request $request): JsonResponse
    {
        $q = $request->get('q', '');
        if (empty($q)) {
            return response()->json([
                'success' => true,
                'data' => []
            ]);
        }

        // Search blogs
        $blogs = Blog::where('is_published', true)
            ->where('title', 'like', "%{$q}%")
            ->limit(3)
            ->get(['title', 'slug', 'summary']);

        // Search services
        $services = Service::where('is_active', true)
            ->where('title', 'like', "%{$q}%")
            ->limit(3)
            ->get(['title', 'slug', 'description']);

        // Search companies
        $companies = Company::where('is_active', true)
            ->where('name', 'like', "%{$q}%")
            ->limit(3)
            ->get(['name as title', 'slug', 'description']);

        // Search projects
        $projects = PortfolioProject::where('title', 'like', "%{$q}%")
            ->limit(3)
            ->get(['title', 'slug', 'summary']);

        return response()->json([
            'success' => true,
            'data' => [
                'blogs' => $blogs,
                'services' => $services,
                'companies' => $companies,
                'projects' => $projects
            ]
        ]);
    }
}
