<?php

namespace App\Livewire\Blog;

use Livewire\Component;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $blogId;
    public $title, $slug, $description, $introduction, $content_table, $first_paragraph, $category, $image, $author_name, $author_title;
    public $image_alt, $index_image_alt, $show_at_home = false, $showed = false;
    public $author_image;

    public function mount($blogId)
    {
        $this->blogId = $blogId;
        $this->loadBlogData();
    }

    public function loadBlogData()
    {
        $blog = Blog::find($this->blogId)->first();

        // dd($blog);
        if ($blog) {
            $this->title = $blog->title;
            $this->slug = $blog->slug;
            $this->description = $blog->description;
            $this->introduction = $blog->introduction;
            $this->content_table = $blog->content_table;
            $this->first_paragraph = $blog->first_paragraph;
            $this->category = $blog->blog_category_id;
            $this->image_alt = $blog->image_alt;
            $this->index_image_alt = $blog->index_image_alt;
            $this->show_at_home = $blog->show_at_home;
            $this->showed = $blog->showed;
            $this->author_name = $blog->author_name;
            $this->author_title = $blog->author_title;
        }
    }

    public function update()
    {
        $validatedData = $this->validate([
            'title' => 'required',
            'slug' => 'required|unique:blogs,slug,' . $this->blogId,
            'description' => 'required',
            'introduction' => 'required',
            'content_table' => 'required',
            'first_paragraph' => 'required',
            'category' => 'required|exists:blog_categories,id',
            'author_name' => 'required',
            'author_title' => 'required',
            'author_image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'image_alt' => 'nullable',
            'index_image_alt' => 'nullable',
        ]);

        $blog = Blog::find($this->blogId);
        $blog->title = $validatedData['title'];
        $blog->slug = Str::slug($validatedData['slug']);
        $blog->description = $validatedData['description'];
        $blog->introduction = $validatedData['introduction'];
        $blog->content_table = $validatedData['content_table'];
        $blog->first_paragraph = $validatedData['first_paragraph'];
        $blog->blog_category_id = $validatedData['category'];
        $blog->author_name = $validatedData['author_name'];
        $blog->author_title = $validatedData['author_title'];
        $blog->image_alt = $validatedData['image_alt'];
        $blog->index_image_alt = $validatedData['index_image_alt'];
        $blog->show_at_home = $this->show_at_home;
        $blog->showed = $this->showed;

        // Handle images if present
        $helper = new \App\Helpers\ImageHelper;

        // Handle main image
        if ($this->image) {
            $helper->removeImageInPublicDirectory($blog->image);
            $blog->image = $helper->storeImageInPublicDirectory($this->image, '/photos/blogs', 800, 550);
        }

        // Handle author image
        if ($this->author_image) {
            $helper->removeImageInPublicDirectory($blog->author_image);
            $blog->author_image = $helper->storeImageInPublicDirectory($this->author_image, '/photos/blogs', 200, 200);
        }

        $blog->save();

        session()->flash('success', 'Blog Updated Successfully!');
        return $this->redirect(route('dashboard.blogs.index'), true);
    }

    public function render()
    {
        $categories = BlogCategory::all();
        return view('livewire.blog.edit', compact('categories'));
    }
}
