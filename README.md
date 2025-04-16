# Blog Creation Form on laravle

This project implements a **blog creation form** that allows users to add new blog posts by providing a title, slug, short description, and content. It also includes an option to upload a thumbnail image for the post.

## Features:

- **Title**: A required field for entering the blog post's title.
- **Slug (URL)**: A URL-friendly slug for the blog post (required).
- **Short Description**: A brief description of the blog post (required).
- **Blog Content**: The main content of the blog post (required).
- **Thumbnail**: Upload a main image for the post (required).
  - Image resolution: ~800x400px, max size 1MB.
  
## Form Layout

The form consists of several fields:

1. **Title and Slug (URL)** are displayed side by side.
2. **Short Description** and **Blog Contents** are provided in text areas.
3. **Thumbnail** allows image upload with a preview.

## How to Use

1. Fill in the blog title, slug, short description, and content.
2. Upload a thumbnail image with the required resolution.
3. Click **Save Post** to submit.
4. Click **Cancel** to go back.

## Example Code

```html
<form id="addblogForm" class="bg-white p-4 rounded shadow-sm mb-5">
  <!-- Title, Slug, Description, Blog Contents, Thumbnail fields here -->
  <div class="d-flex justify-content-end gap-2">
    <button type="button" class="btn btn-secondary" onclick="window.history.back();">Cancel</button>
    <button type="submit" class="btn btn-primary">Save Post</button>
  </div>
</form>
