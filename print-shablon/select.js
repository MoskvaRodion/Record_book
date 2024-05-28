const SELECTS = document.querySelector(".allSelects");
const FORM = document.querySelectorAll(".form-status");
let lastIndex = 0;

SELECTS.addEventListener("change", () => {
  if (SELECTS.value == "none") {
    FORM.forEach((element) => {
      element.style.display = "none";
    });
  } else {
    FORM[lastIndex].style.display = "none";

    let index = SELECTS.value;
    FORM[index].style.display = "block";

    lastIndex = index;
  }
});
