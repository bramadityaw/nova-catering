const allSideMenu = document.querySelectorAll("#sidebar .side-menu.top li a");

if (allSideMenu) {
  allSideMenu.forEach((item) => {
    const li = item.parentElement;

    item.addEventListener("click", function () {
      allSideMenu.forEach((i) => {
        if (i.parentElement) {
          i.parentElement.classList.remove("active");
        }
      });
      if (li) {
        li.classList.add("active");
      }
    });
  });
}

// TOGGLE SIDEBAR
const menuBar = document.querySelector("#content nav .bx.bx-menu");
const sidebar = document.getElementById("sidebar");
const imgLogo = document.querySelector("#sidebar .brand .img-logo");

if (menuBar && sidebar && imgLogo) {
  menuBar.addEventListener("click", function () {
    sidebar.classList.toggle("hide");
    imgLogo.classList.toggle("collapsed");
  });
}

const searchButton = document.querySelector(
  "#content nav form .form-input button"
);
const searchButtonIcon = document.querySelector(
  "#content nav form .form-input button .bx"
);
const searchForm = document.querySelector("#content nav form");

if (searchButton && searchButtonIcon && searchForm) {
  searchButton.addEventListener("click", function (e) {
    if (window.innerWidth < 576) {
      e.preventDefault();
      searchForm.classList.toggle("show");
      if (searchForm.classList.contains("show")) {
        searchButtonIcon.classList.replace("bx-search", "bx-x");
      } else {
        searchButtonIcon.classList.replace("bx-x", "bx-search");
      }
    }
  });

  if (window.innerWidth < 768) {
    sidebar?.classList.add("hide");
  } else if (window.innerWidth > 576) {
    searchButtonIcon.classList.replace("bx-x", "bx-search");
    searchForm.classList.remove("show");
  }

  window.addEventListener("resize", function () {
    if (this.innerWidth > 576) {
      searchButtonIcon.classList.replace("bx-x", "bx-search");
      searchForm.classList.remove("show");
    }
  });
}

const switchMode = document.getElementById("switch-mode");

if (switchMode) {
  switchMode.addEventListener("change", function () {
    if (this.checked) {
      document.body.classList.add("dark");
    } else {
      document.body.classList.remove("dark");
    }
  });
}
