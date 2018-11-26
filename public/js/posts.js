/**
 * Created by Mamdouh on 26/11/2018.
 */
$(document).ready(function () {
    // Add Post
    $(document).on('submit', '#addPost', function (e) {
        e.preventDefault();
        const form = $(this);
        const path = form.attr('action');
        const formData = form.serialize();
        $.ajax({
            url: path,
            type: 'POST',
            data: formData,
            success: function (data) {
                if (data.status === 'success'){
                    $('#posts-container').prepend(data.post);
                    form.trigger("reset");
                }
            },
            error: function(data, exception){
                swalError(data, exception);
            }
        })
    });
    // Edit Post Form
    $(document).on('click', '.editPost', function (e) {
        e.preventDefault();
        const elem = $(this);
        elem.closest('.post-card').slideUp();
        $(elem.attr('data-form')).slideDown();
    });
    // Cancel Edit
    $(document).on('click', '.editCancel', function (e) {
        const elem = $(this);
        $(elem.attr('data-card')).slideDown();
        elem.closest('.editForm').slideUp();
    });
    // Update Post
    $(document).on('submit', '.updatePost', function (e) {
        e.preventDefault();
        const form = $(this);
        const path = form.attr('action');
        const formData = form.serialize();
        $.ajax({
            url: path,
            type: 'POST',
            data: formData,
            success: function (data) {
                if (data.status === 'success'){
                    const oldCard = '#post'+data.postId;
                    $(oldCard).html(data.post);
                }
            },
            error: function(data, exception){
                swalError(data, exception);
            }
        });
    });
    // Delete Post
    $(document).on('click', '.deletePost', function (e) {
        e.preventDefault();
        const elem = $(this);
        const path = elem.attr('data-url');
        const post = elem.closest('.post-card');
        $.ajax({
            url: path,
            type: 'DELETE',
            success: function (data) {
                if (data.status === 'success'){
                    post.slideUp("normal", function(){ $(this).remove(); });
                }
            },
            error: function (data, exception) {
                swalError(data, exception);
            }
        });
    })
    // Comment
});