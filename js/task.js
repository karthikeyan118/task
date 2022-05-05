// dropdown

let link = document.getElementById("link");
const dropdown = document.getElementById("sub-menu-1");
const register = document.getElementById("submit");

// clicking the link
let counter = 0;
link.addEventListener("click", function () {
  counter++;
  for (let i = 0; i <= counter; i++) {
    if (i % 2 == 0) {
      dropdown.style.display = "none";
    } else {
      dropdown.style.display = "block";
    }
  }
});

//submitting form
function validation() {
  let inValue = document.myform.SearchValue.value;
  if (inValue == null || inValue == "") {
    alert("Please enter the Title");
    return false;
  }
}
