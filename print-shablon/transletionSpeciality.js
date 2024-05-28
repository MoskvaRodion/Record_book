const Radios = document.querySelectorAll('input[name="choice"]');
const SPECIALTY = document.querySelector("#ANOTHER_SPECIALTY");
const EDUCATION = document.querySelector("#FORM_OF_EDUCATION");

Radios.forEach((radio) => {
  radio.addEventListener("change", function () {
    if (radio.value == "spec") {
      SPECIALTY.style.display = "block";
      EDUCATION.style.display = "none";
    } else if (radio.value == "formLearning") {
      SPECIALTY.style.display = "none";
      EDUCATION.style.display = "block";
    }
  });
});

window.addEventListener("load", function () {
  EDUCATION.style.display = "none";
});
