<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // PHƯƠNG THỨC INDEX CŨ CỦA BẠN (GIỮ NGUYÊN)
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.category_manager', compact('categories'));
    }
    
    /**
     * BỔ SUNG: Xử lý lưu Danh mục mới (Create) - Ánh xạ admin.categories.store
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255|unique:category,name', // SỬA: Dùng 'category' thay vì 'categories' để khớp với Model
            'description' => 'nullable|string|max:500',
        ]);

        Category::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('admin.category.manager')->with('success', 'Đã thêm danh mục mới thành công.');
    }

    /**
     * BỔ SUNG: Hiển thị form chỉnh sửa (Edit) - Ánh xạ admin.categories.edit
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        // Trả về view: resources/views/admin/categories/edit.blade.php
        return view('admin.edit_category_manager', compact('category'));
    }

    /**
     * BỔ SUNG: Xử lý lưu thay đổi (Update) - Ánh xạ admin.categories.update
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        // Validation
        $request->validate([
            'name' => 'required|string|max:255|unique:category,name,' . $category->id, // SỬA: Dùng 'category' thay vì 'categories'
            'description' => 'nullable|string|max:500',
        ]);

        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->save();

        return redirect()->route('admin.category.manager')->with('success', 'Đã cập nhật danh mục thành công.');
    }

    /**
     * BỔ SUNG: Xóa Danh mục (Delete) - Ánh xạ admin.categories.delete
     */
    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $categoryName = $category->name;
        $category->delete();

        return redirect()->route('admin.category.manager')->with('success', "Đã xóa danh mục '$categoryName' thành công.");
    }
}