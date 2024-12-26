    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chapters = document.querySelectorAll('.TOCchapter');

            chapters.forEach(chapter => {
                chapter.addEventListener('click', function() {
                    chapter.classList.toggle('TOCopen');
                });
            });
        });
    </script>