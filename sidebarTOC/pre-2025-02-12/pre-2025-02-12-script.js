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
