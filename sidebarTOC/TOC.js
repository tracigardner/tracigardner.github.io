document.addEventListener("DOMContentLoaded", function () {
  const chapters = document.querySelectorAll(".TOCchapter");

  chapters.forEach((chapter) => {
    chapter.addEventListener("click", function () {
      chapter.classList.toggle("TOCopen");
    });
  });

  // Automatically highlight the current page based on the URL
  const links = document.querySelectorAll(".TOCsidebar a");
  let currentPage = window.location.href.split("#")[0]; // Strip anchor id from the URL
  // drop this old code-- const currentPage = window.location.href; //

  links.forEach((link) => {
    if (link.href === currentPage) {
      link.classList.add("TOCcurrent");
      const parentChapter = link.closest(".TOCchapter");
      if (parentChapter) {
        parentChapter.classList.add("TOCopen");
      }
    }
  });
});
--------------------------

document.addEventListener("DOMContentLoaded", function() {
  function toggleChapter(element) {
      let subpages = element.nextElementSibling;
      let isOpen = subpages.style.display === 'block';
      subpages.style.display = isOpen ? 'none' : 'block';
      element.classList.toggle('open', !isOpen);
  }

  function highlightCurrentPage() {
      let links = document.querySelectorAll('.TOCsubpages a');
      let currentPage = window.location.pathname.split('/').pop().split('#')[0].split('?')[0];
      links.forEach(link => {
          if (link.getAttribute('href') === currentPage) {
              link.classList.add('active');
              let chapter = link.closest('.TOCsubpages');
              chapter.style.display = 'block'; // Keep open
              chapter.previousElementSibling.classList.add('open');
          }
      });
  }

  highlightCurrentPage();
  
  // Attach event listeners to all chapter elements
  document.querySelectorAll('.TOCchapter').forEach(chapter => {
      chapter.addEventListener('click', function() {
          toggleChapter(this);
      });
  });
});








document.addEventListener("DOMContentLoaded", function () {
  const chapters = document.querySelectorAll(".TOCchapter");

  chapters.forEach((chapter) => {
    chapter.addEventListener("click", function () {
      chapter.classList.toggle("TOCopen");
    });
  });

  // Automatically highlight the current page based on the URL
  const links = document.querySelectorAll(".TOCsidebar a");
  let currentPage = window.location.href.split("#")[0]; // Strip anchor id from the URL
  // drop this old code-- const currentPage = window.location.href; //

  links.forEach((link) => {
    if (link.href === currentPage) {
      link.classList.add("TOCcurrent");
      const parentChapter = link.closest(".TOCchapter");
      if (parentChapter) {
        parentChapter.classList.add("TOCopen");
      }
    }
  });
});