document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.toggle-comments').forEach(function(button) {
        button.addEventListener('click', function() {
            var postElement = this.closest('.post');
            var allComments = postElement.querySelector('.all-comments');
            var isHidden = allComments.classList.contains('hidden');

            if (isHidden) {
                allComments.classList.remove('hidden');
                allComments.classList.add('show');
                this.textContent = 'Hide Comments';
            } else {
                allComments.classList.remove('show');
                allComments.classList.add('hidden');
                this.textContent = 'Show More Comments';
            }
        });
    });
});
