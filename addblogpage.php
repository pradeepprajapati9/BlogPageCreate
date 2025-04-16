<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Blogs Pages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Use the new ID for styling if needed, or keep generic */
        #blogListTable .blog-thumbnail { max-width: 100px; max-height: 50px; object-fit: cover; display: block; margin: auto; }
        #blogListTable td { word-break: break-word; max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; vertical-align: middle; }
        #blogListTable td.description-cell { white-space: normal; max-height: 100px; overflow-y: auto; vertical-align: top; }
        #blogListTable td.description-cell div { max-height: 80px; overflow-y: auto; }
        .note-editor.note-frame { min-height: 200px; }
        #edit-thumbnail-preview, #featured-image-preview { max-width: 130px; max-height: 80px; object-fit: cover; margin-top: 10px; display: none; }
        .form-control-sm { max-width: 300px; }
        .bg-light .border { background-color: #f8f9fa !important; border-color: #dee2e6 !important; }
        #blogListTable tbody tr td[colspan="7"] { white-space: normal; text-align: center; }
    </style>
</head>

 
<body class="bg-light">
    <div class="container">
        <main class="py-4">
            <h1 class="fs-3 fw-semibold mb-4">Add New Blog</h1>

            <!-- Add Blog Form (no changes) -->
            <form id="addblogForm" class="bg-white p-4 rounded shadow-sm mb-5">
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" placeholder="Enter title" class="form-control" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="slug" class="form-label">Slug (URL)</label>
                        <input type="text" name="url" id="slug" class="form-control" placeholder="Enter slug (e.g., test-blog-url)" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="short-description" class="form-label">Short Description</label>
                    <textarea name="short_description" id="short-description" rows="4" placeholder="Enter short description" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="blog-contents" class="form-label">Blog Contents (Description)</label>
                    <textarea name="description" id="blog-contents" class="form-control" placeholder="Enter blog content..." required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Thumbnail</label>
                    <div class="d-flex align-items-start p-4 border rounded bg-light">
                        <img class="me-4" id="featured-image-preview" src="" alt="Featured image preview">
                        <div>
                            <p class="text-muted mb-1">Main image:</p>
                            <p class="text-muted small mb-2">Required image resolution ~800x400, max size 1mb.</p>
                            <input type="file" id="featured-image-upload" name="thumbnail" class="form-control form-control-sm" accept="image/*" required>
                        </div>
                    </div>
                </div>
                <div class="pt-3 border-top mt-4">
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Post</button>
                    </div>
                </div>
            </form>

            <!-- Blog List Table -->
            <div class="row g-3 mb-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                            <h6 class="m-0 fw-bold">All Blog List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- **************************** -->
                                <!-- ** CHANGED ID HERE ** -->
                                <!-- **************************** -->
                                <table id="blogListTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center; width: 5%;">Id</th>
                                            <th style="text-align: center; width: 15%;">Url</th>
                                            <th style="text-align: center; width: 15%;">Title</th>
                                            <th style="text-align: center; width: 20%;">Short Description</th>
                                            <th style="text-align: center; width: 25%;">Description</th>
                                            <th style="text-align: center; width: 10%;">Thumbnail</th>
                                            <th style="text-align: center; width: 10%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data will be loaded here by JavaScript -->
                                         <tr><td colspan="7" class="text-center">Initializing...</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Edit Blog Modal (no changes) -->
    <div class="modal fade" id="editBlogModal" tabindex="-1" aria-labelledby="editBlogModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBlogModalLabel">Edit Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editBlogForm">
                        <input type="hidden" id="edit-blog-id">
                        <div class="row">
                           <div class="mb-3 col-md-6">
                                <label for="edit-title" class="form-label">Title</label>
                                <input type="text" id="edit-title" class="form-control" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="edit-slug" class="form-label">Slug (URL)</label>
                                <input type="text" id="edit-slug" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="edit-short-description" class="form-label">Short Description</label>
                            <textarea id="edit-short-description" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit-blog-content" class="form-label">Content</label>
                            <textarea id="edit-blog-content" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                             <label for="edit-thumbnail" class="form-label">Update Thumbnail (Optional)</label>
                             <div class="d-flex align-items-start p-3 border rounded bg-light">
                                 <img id="edit-thumbnail-preview" src="" alt="Current/New thumbnail preview" class="me-3">
                                 <div>
                                     <p class="text-muted small mb-2">Leave empty to keep the current thumbnail. <br> Max size 1mb.</p>
                                     <input type="file" id="edit-thumbnail" class="form-control form-control-sm" accept="image/*">
                                 </div>
                             </div>
                        </div>
                        <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                             <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            // --- Configuration ---
            const MAX_THUMBNAIL_SIZE = 1 * 1024 * 1024; // 1MB
            const PLACEHOLDER_IMAGE_PATH = 'path/to/placeholder.png'; // ** IMPORTANT: Set a real path **
            const TABLE_ID_SELECTOR = '#blogListTable'; // Centralize the selector

            const addForm = $("#addblogForm");
            const addPreview = $('#featured-image-preview');
            const editPreview = $('#edit-thumbnail-preview');

            // --- PHP Variables ---
            const add_blog_url = "<?php echo $add_blog ?? ''; ?>";
            const get_blog_url = "<?php echo $get_blog ?? ''; ?>";
            const delete_blog_url = "<?php echo $delete_blog ?? ''; ?>";
            const edit_blog_url ="<?php echo $edit_blog ?? ''; ?>";

            let dataTableInstance = null;

            // --- Helper Functions ---
            const showAlert = (title, text, icon = 'error') => Swal.fire({ icon, title, text });

            const handleFileChange = (event, previewElement) => {
                const file = event.target.files[0];
                if (file) {
                    if (file.size <= MAX_THUMBNAIL_SIZE) {
                        const reader = new FileReader();
                        reader.onload = (e) => previewElement.attr('src', e.target.result).show();
                        reader.readAsDataURL(file);
                    } else {
                        showAlert('File Too Large', `Maximum size is ${MAX_THUMBNAIL_SIZE / 1024 / 1024}MB.`);
                        previewElement.hide().attr('src', '');
                        event.target.value = null;
                    }
                } else {
                     previewElement.hide().attr('src', '');
                }
            };

            // --- Summernote Initialization ---
            const summernoteOptions = {
                placeholder: 'Enter content...', tabsize: 2, height: 250,
                toolbar: [
                    ['style', ['style']], ['font', ['bold', 'underline', 'clear']], ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']], ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']], ['view', ['fullscreen', 'codeview', 'help']]
                ]
            };
            $('#blog-contents').summernote({...summernoteOptions, placeholder: 'Enter blog content...'});
            $('#edit-blog-content').summernote({...summernoteOptions, placeholder: 'Edit blog content...', height: 200});

            // --- Event Listeners ---
            $('#featured-image-upload').on('change', function(event) {
                handleFileChange(event, addPreview);
            });

             $('#edit-thumbnail').on('change', function(event) {
                handleFileChange(event, editPreview);
            });

            // Add Blog Form Submission
            addForm.on('submit', async function(e) {
                e.preventDefault();
                $('#blog-contents').val($('#blog-contents').summernote('code'));
                const fileInput = document.getElementById('featured-image-upload');
                if (!fileInput.files || fileInput.files.length === 0) {
                    showAlert('Missing Thumbnail', 'Please select a thumbnail image.', 'warning');
                    return;
                }
                const formData = new FormData(this);
                Swal.fire({ title: 'Submitting...', text: 'Please wait...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
                try {
                    const response = await fetch(add_blog_url, { method: "POST", body: formData });
                    const result = await response.json();
                    Swal.close();
                    if (response.ok && result.status) {
                        Swal.fire({ icon: "success", title: "Success!", text: result.message || "Blog added successfully!" })
                            .then(() => resetAddForm());
                    } else {
                        showAlert("Submission Error", result.message || `Server responded with status: ${response.status}`);
                    }
                } catch (error) {
                    Swal.close();
                    console.error("Add form submission error:", error);
                    showAlert("Request Error", "Could not submit the form. Check console for details.");
                }
            });

            // Edit Blog Form Submission
            $('#editBlogForm').on('submit', async function(e) {
                e.preventDefault();
                $('#edit-blog-content').val($('#edit-blog-content').summernote('code'));
                const blogId = $('#edit-blog-id').val();
                const title = $('#edit-title').val();
                const slug = $('#edit-slug').val();
                const shortDescription = $('#edit-short-description').val();
                const description = $('#edit-blog-content').val();
                const thumbnailFile = $('#edit-thumbnail')[0].files[0];

                if (!title || !slug || !shortDescription) {
                    showAlert('Missing Fields', 'Please fill in Title, Slug, and Short Description.', 'warning');
                    return;
                }
                const formData = new FormData();
                formData.append('id', blogId);
                formData.append('title', title);
                formData.append('url', slug);
                formData.append('short_description', shortDescription);
                formData.append('description', description);
                if (thumbnailFile) {
                    if (thumbnailFile.size > MAX_THUMBNAIL_SIZE) {
                        showAlert('File Too Large', `Maximum thumbnail size is ${MAX_THUMBNAIL_SIZE / 1024 / 1024}MB.`, 'error');
                        return;
                    }
                    formData.append('thumbnail', thumbnailFile);
                }
                Swal.fire({ title: 'Updating...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
                try {
                    const response = await fetch(edit_blog_url, { method: "POST", body: formData });
                    const result = await response.json();
                    Swal.close();
                    if (response.ok && result.status) {
                        const editModalEl = document.getElementById('editBlogModal');
                        const modalInstance = bootstrap.Modal.getInstance(editModalEl);
                        if (modalInstance) modalInstance.hide();
                        Swal.fire({ icon: 'success', title: 'Success', text: result.message || 'Blog updated successfully!' })
                            .then(() => loadBlogData());
                    } else {
                        showAlert('Update Error', result.message || 'Failed to update blog.');
                    }
                } catch (error) {
                    Swal.close();
                    console.error('Error during update:', error);
                    showAlert('Network Error', 'Could not connect to the server to update.');
                }
            }); 
           $(TABLE_ID_SELECTOR + ' tbody').on('click', '.edit-blog', async function() {
    const blogId = $(this).data('id'); // Get the correct blog ID for the clicked row

    // Check if the correct blogId is fetched (for debugging)
    console.log('Editing blog with ID:', blogId);

    Swal.fire({
        title: 'Loading Editor...',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });

    try {
        const myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");

        // Prepare the request payload
        const raw = JSON.stringify({ "id": blogId });

        const requestOptions = {
            method: "POST",
            headers: myHeaders,
            body: raw,
            redirect: "follow"
        };

        // Fetch data from the API
        const response = await fetch("get_blog_id.php", requestOptions);
        const result = await response.json(); // Parse the JSON response

        Swal.close();

        if (response.ok && result.status) {
            const blog = result.data; // Extract the blog data from the response

            if (blog) {
                // Populate the edit form with the blog's data
                $('#edit-blog-id').val(blog.id);
                $('#edit-title').val(blog.title || '');
                $('#edit-slug').val(blog.url || '');
                $('#edit-short-description').val(blog.short_description || '');
                $('#edit-blog-content').summernote('code', blog.description || '');
                $('#edit-thumbnail-preview').hide().attr('src', '');
                $('#edit-thumbnail').val('');

                // If a thumbnail exists, show it
                if (blog.thumbnail) {
                    $('#edit-thumbnail-preview').attr('src', `${blog.thumbnail}`).show();
                }

                // Open the edit modal
                const editModal = new bootstrap.Modal(document.getElementById('editBlogModal'));
                editModal.show();
            } else {
                showAlert('Data Error', 'Could not find blog data in the response.');
            }
        } else {
            showAlert('Load Error', result.message || 'Failed to load blog data for editing.');
        }
    } catch (error) {
        Swal.close();
        console.error('Error fetching blog data for edit:', error);
        showAlert('Network Error', 'Could not fetch blog data. Check connection or console.');
    }
});

 
            $(TABLE_ID_SELECTOR + ' tbody').on('click', '.delete-blog', async function() {
                const blogId = $(this).data('id');
                const confirmResult = await Swal.fire({
                    title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning',
                    showCancelButton: true, confirmButtonColor: '#d33', cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                });
                if (confirmResult.isConfirmed) {
                    Swal.fire({ title: 'Deleting...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
                    try {
                        const formData = new FormData();
                        formData.append("id", blogId);
                        const response = await fetch(delete_blog_url, { method: "POST", body: formData });
                        const result = await response.json();
                        Swal.close();
                        if (response.ok && result.status) {
                            Swal.fire('Deleted!', result.message || 'The blog has been deleted.', 'success');
                            loadBlogData();
                        } else {
                             Swal.fire('Error!', result.message || 'Failed to delete the blog.', 'error');
                        }
                    } catch (error) {
                         Swal.close();
                        console.error('Error during delete:', error);
                        Swal.fire('Network Error', 'Failed to connect to the server for deletion.', 'error');
                    }
                }
            });


            // --- Form Reset ---
            const resetAddForm = () => {
                addForm[0].reset();
                $('#blog-contents').summernote('reset');
                addPreview.hide().attr('src', '');
                $('#featured-image-upload').val(null);
                loadBlogData();
            };

            // --- Data Loading and Table Population ---
            async function loadBlogData() {
             
                const tableBody = $(TABLE_ID_SELECTOR + ' tbody');
                 tableBody.html('<tr><td colspan="7" class="text-center">Loading data... <span class="spinner-border spinner-border-sm"></span></td></tr>');

                 // Destroy logic remains the same (using the instance variable)
                 if (dataTableInstance) {
                     try {
                      
                     } catch(e) {
                         console.error("Error destroying previous DataTable instance:", e);
                     }
                 }

                try {
                    const response = await fetch(get_blog_url, { method: "POST" });
                    const result = await response.json();

                    if (response.ok && result.status) {
                        populateTable(result.data);
                    } else {
                        tableBody.html('<tr><td colspan="7" class="text-center">Error loading data: '+(result.message || 'Unknown server error')+'</td></tr>');
                        showAlert("Data Loading Error", result.message || "Failed to fetch blog data from the server.");
                    }
                } catch (error) {
                    console.error("Fetch error:", error);
                    tableBody.html('<tr><td colspan="7" class="text-center">Network error while loading data. Check console.</td></tr>');
                    showAlert("Network Error", "Could not fetch data from the server. Please check your connection.");
                }
            }

            function populateTable(data) {
                // ****************************
                // ** UPDATED SELECTOR HERE **
                // ****************************
                const tableBody = $(TABLE_ID_SELECTOR + ' tbody');
                tableBody.empty();

                if (!Array.isArray(data)) {
                    console.error("Invalid data received from API. Expected array, got:", data);
                    tableBody.html('<tr><td colspan="7" class="text-center text-danger">Error: Invalid data format received from server.</td></tr>');
                    return;
                }

                if (data.length > 0) {
                    data.forEach(blog => {
                        const thumbnailUrl = blog.thumbnail ? `${blog.thumbnail}` : PLACEHOLDER_IMAGE_PATH;
                        const descriptionHtml = blog.description ? blog.description : '<span class="text-muted fst-italic">No description</span>';
                        const titleDisplay = blog.title || '<span class="text-muted fst-italic">No title</span>';
                        const urlDisplay = blog.url || '<span class="text-muted fst-italic">No URL</span>';
                        const shortDescDisplay = blog.short_description || '<span class="text-muted fst-italic">No short description</span>';

                        tableBody.append(`
                            <tr>
                                <td class="text-center">${blog.id}</td>
                                <td class="text-start">${urlDisplay}</td>
                                <td class="text-start">${titleDisplay}</td>
                                <td class="text-start">${shortDescDisplay}</td>
                                <td class="text-start description-cell">
                                    <div>${descriptionHtml}</div>
                                </td>
                                <td class="text-center">
                                    <img src="${thumbnailUrl}" alt="Thumbnail" class="blog-thumbnail" loading="lazy" onerror="this.onerror=null; this.src='${PLACEHOLDER_IMAGE_PATH}'; this.alt='Missing Image';">
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning edit-blog" data-id="${blog.id}" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/></svg>
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-blog" data-id="${blog.id}" title="Delete">
                                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16"><path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/></svg>
                                    </button>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    tableBody.html('<tr><td colspan="7" class="text-center">No blogs found.</td></tr>');
                    return; // Do not initialize if no data
                }

                // --- Initialize DataTables ---
                 try {
               
                     dataTableInstance = $(TABLE_ID_SELECTOR).DataTable({
                          "pageLength": 10,
                          "order": [[0, 'desc']],
                          "destroy": true, // Crucial for re-initialization
                          "stateSave": false // Optional: Disable saving table state
                     });
                 } catch (e) {
                     console.error("Error initializing DataTable:", e);
                   
                     $(TABLE_ID_SELECTOR + ' tbody').prepend('<tr><td colspan="7" class="text-center text-danger fw-bold">Error initializing table display. Check console.</td></tr>');
                 }
            }

            // --- Initial Load ---
            loadBlogData();

        }); // End document ready
    </script>
</body>
</html>