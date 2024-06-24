document.addEventListener("DOMContentLoaded", function () {
  const listings = document.querySelectorAll(".listing");
  const prevBtn = document.querySelector(".pagination-btn-prev");
  const nextBtn = document.querySelector(".pagination-btn-next");
  const pageInfo = document.querySelector(".page-info");

  let currentPage = 1;
  const listingsPerPage = window.innerWidth < 768 ? 1 : 3;
  const totalPages = Math.ceil(listings.length / listingsPerPage);

  function showPage(page) {
    listings.forEach((listing, index) => {
      listing.style.display =
        index >= (page - 1) * listingsPerPage && index < page * listingsPerPage
          ? "block"
          : "none";
    });

    prevBtn.disabled = page === 1;
    nextBtn.disabled = page === totalPages;
    pageInfo.textContent = `Page ${page} of ${totalPages}`;
  }

  prevBtn.addEventListener("click", function () {
    if (currentPage > 1) {
      currentPage--;
      showPage(currentPage);
    }
  });

  nextBtn.addEventListener("click", function () {
    if (currentPage < totalPages) {
      currentPage++;
      showPage(currentPage);
    }
  });

  showPage(currentPage);
});
