<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::latest()->paginate(10);
        return view('admin.sections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.sections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:sections',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|max:2048'
        ]);

        $data = $request->except('image_path');
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('sections', 'public');
        }

        Section::create($data);

        return redirect()->route('admin.sections.index')->with('success', 'Section created successfully.');
    }

    public function show(Section $section)
    {
        return redirect()->route('admin.sections.edit', $section);
    }

    public function edit(Section $section)
    {
        return view('admin.sections.edit', compact('section'));
    }

    public function update(Request $request, Section $section)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:sections,name,' . $section->id,
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|max:2048'
        ]);

        $data = $request->except('image_path');
        
        // Only update slug if name changed to keep SEO somewhat intact, or always update. Standard is always update or keep old. Let's always update for simplicity.
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('sections', 'public');
        }

        $section->update($data);

        return redirect()->route('admin.sections.index')->with('success', 'Section updated successfully.');
    }

    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('admin.sections.index')->with('success', 'Section deleted successfully.');
    }
}
