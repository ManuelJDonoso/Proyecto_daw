const section1 = document.querySelector(".section--one");
const section2 = document.querySelector(".section--two");
const section3 = document.querySelector(".section--three");
const ico_show_cat=document.getElementById("ico_cat");
const toggleButton = document.getElementById("toggleSection1");



// Restaurar posiciones guardadas
function restoreLayout() {
  const savedLayout = sessionStorage.getItem("layout");
  if (savedLayout) {
    const { section1Width, section2Width, section3Width, hidden } =
      JSON.parse(savedLayout);

    if (hidden) {
      section1.classList.add("section--hidden");
    } else {
      section1.classList.remove("section--hidden");
    }

    section1.style.flexBasis = section1Width;
    section2.style.flexBasis = section2Width;
    section3.style.flexBasis = section3Width;
  }
}

function saveLayout() {
  sessionStorage.setItem(
    "layout",
    JSON.stringify({
      section1Width: section1.style.flexBasis,
      section2Width: section2.style.flexBasis,
      section3Width: section3.style.flexBasis,
      hidden: section1.classList.contains("section--hidden"),
    })
  );
}

toggleButton.addEventListener("click", () => {
  if(section1.classList.contains("section--hidden")){
    ico_show_cat.classList.remove("fa-eye-slash");
  }else{
    ico_show_cat.classList.add("fa-eye-slash");
  }

  if (section1.classList.contains("section--hidden")) {
    section1.classList.remove("section--hidden");
    section2.style.flexBasis = "33.3%";
    section3.style.flexBasis = "33.3%";
  
  
  } else {
    section1.classList.add("section--hidden");
    section2.style.flexBasis = "33.3%";
    section3.style.flexBasis = "66.6%";

  }
  saveLayout();
});

function makeResizable(resizer, prevSection, nextSection) {
  let isResizing = false;

  resizer.addEventListener("mousedown", () => {
    isResizing = true;
    document.addEventListener("mousemove", onMouseMove);
    document.addEventListener("mouseup", onMouseUp);
  });

  function onMouseMove(e) {
    if (!isResizing) return;

    let containerWidth = document.querySelector(".container").clientWidth;
    let prevWidth = (e.clientX / containerWidth) * 100;
    let nextWidth = 100 - prevWidth - 1.5;

    prevSection.style.flexBasis = `${prevWidth}%`;
    nextSection.style.flexBasis = `${nextWidth}%`;

    saveLayout();
  }

  function onMouseUp() {
    isResizing = false;
    document.removeEventListener("mousemove", onMouseMove);
    document.removeEventListener("mouseup", onMouseUp);
  }
}

makeResizable(document.getElementById("resizer1"), section1, section2);
makeResizable(document.getElementById("resizer2"), section2, section3);

// Restaurar configuración al cargar la página
restoreLayout();
