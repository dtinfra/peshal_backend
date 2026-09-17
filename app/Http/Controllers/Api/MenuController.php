<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SiteMenu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $key = $request->query('key', 'main_nav');
        $menus = SiteMenu::where('menu_key', $key)
            ->whereNull('parent_id')
            ->where('is_visible', true)
            ->orderBy('order', 'asc')
            ->with('children')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $menus
        ]);
    }

    public function allMenus()
    {
        $menus = SiteMenu::whereNull('parent_id')
            ->orderBy('order', 'asc')
            ->with('children')
            ->get()
            ->groupBy('menu_key');

        return response()->json([
            'success' => true,
            'data' => $menus
        ]);
    }

    public function updateMenus(Request $request)
    {
        $validated = $request->validate([
            'menu_key' => 'required|string',
            'items' => 'required|array',
            'items.*.label' => 'required|string',
            'items.*.url' => 'required|string',
            'items.*.order' => 'integer',
            'items.*.is_visible' => 'boolean',
        ]);

        $key = $validated['menu_key'];
        SiteMenu::where('menu_key', $key)->delete();

        foreach ($validated['items'] as $index => $item) {
            SiteMenu::create([
                'menu_key' => $key,
                'label' => $item['label'],
                'url' => $item['url'],
                'order' => $item['order'] ?? ($index + 1),
                'is_visible' => $item['is_visible'] ?? true,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Site navigation updated successfully'
        ]);
    }
}
