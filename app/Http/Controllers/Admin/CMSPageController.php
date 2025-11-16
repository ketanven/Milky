<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CMSPage;
use Illuminate\Support\Str;

class CMSPageController extends Controller
{
    // List all CMS pages
    public function index()
    {
        $pages = CMSPage::orderBy('order')->get();
        return view('Admin.cms.index', compact('pages'));
    }

    // Show form for creating/editing page
    public function edit($id)
    {
        $page = $id == 0 ? new CMSPage() : CMSPage::findOrFail($id);
        return view('Admin.cms.edit', compact('page'));
    }

    // Store or update page
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'is_active' => 'nullable|boolean',
        ]);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),       // auto generate slug
            'content' => $request->content,
            'is_active' => $request->has('is_active'),
        ];

        // Auto set order as last if creating
        if ($id == 0) {
            $lastOrder = CMSPage::max('order') ?? 0;
            $data['order'] = $lastOrder + 1;
            CMSPage::create($data);
            return redirect()->route('admin.cms.index')->with('success', 'Page created successfully!');
        }

        // Update existing page
        $page = CMSPage::findOrFail($id);
        $page->update($data);

        return redirect()->route('admin.cms.index')->with('success', 'Page updated successfully!');
    }

    // Public view
    public function show($slug)
    {
        $page = CMSPage::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('admin.cms.show', compact('page'));
    }

    // Optional: delete page
    public function destroy($id)
    {
        $page = CMSPage::findOrFail($id);
        $page->delete();
        return redirect()->route('admin.cms.index')->with('success', 'Page deleted successfully!');
    }
}
