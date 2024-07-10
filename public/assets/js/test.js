const categoryButtons = document.querySelectorAll(".category-button");
const page = document.body;

const themeClasses = {
  light: "bg-gray-100",
  dark: "dark-page",
  kid: "kid-page",
  young: "young-page",
  adult: "adult-page",
};

let currentTheme = localStorage.getItem("theme");

function setTheme(theme) {
  localStorage.setItem("theme", theme);
}

function setNormalText() {
  // Restaura el color original de todos los elementos en el cuerpo, incluyendo navbar y sidebar
  const allTextElements = document.querySelectorAll("*");
  allTextElements.forEach((element) => {
    element.style.color = ""; // Deja que los estilos originales se apliquen
  });

  // Restaura el color original de los iconos
  const iconElements = document.querySelectorAll(".nav-link .icon i");
  iconElements.forEach((element) => {
    element.style.color = "#1d365d"; // Cambia esto al color original de tus iconos
  });
  // Aplica la clase text-white solo a los iconos de Font Awesome
  const fontAwesomeIcons = document.querySelectorAll("td .fas");
  fontAwesomeIcons.forEach((icon) => {
    icon.classList.add("text-secondary");
    icon.classList.remove("text-white");
  });

  // Restaura el color original de los íconos de los elementos no activos
  const inactiveIconElements = document.querySelectorAll(
    ".nav-item:not(.active) .icon i"
  );
  inactiveIconElements.forEach((element) => {
    element.style.color = "#1d365d"; // Cambia esto al color original de tus íconos
  });
  console.log("setNormalText()");

  const selectElements = document.querySelectorAll("select");
  selectElements.forEach((select) => {
    select.style.color = ""; // Deja que los estilos originales se apliquen
    const optionElements = select.querySelectorAll("option");
    optionElements.forEach((option) => {
      option.style.color = ""; // Deja que los estilos originales se apliquen
    });
  });
}

function setDarkTheme() {
  // Restaura el color original de todos los elementos en el cuerpo, incluyendo navbar y sidebar
  const allTextElements = document.querySelectorAll("*");
  allTextElements.forEach((element) => {
      element.style.color = "#fff";
  });

  // Restaura el color original de los iconos dentro de .nav-item.active .icon i
  const navIconElements = document.querySelectorAll(
      ".nav-item.active .icon i"
  );
  navIconElements.forEach((element) => {
      element.style.color = "#fff"; // Cambia esto al color original de tus íconos en modo oscuro
  });

  // Restaura el color original de los iconos
  const iconElements = document.querySelectorAll(".nav-link .icon i");
  iconElements.forEach((element) => {
      element.style.color = "#1d365d"; // Cambia esto al color original de tus iconos
  });

  // Aplica la clase text-white solo a los iconos de Font Awesome dentro de las celdas de la tabla
  const tableIconElements = document.querySelectorAll("td .fas");
  tableIconElements.forEach((icon) => {
      icon.classList.add("text-white");
      icon.classList.remove("text-secondary");
  });



  // Restaura el color original de las fechas dentro de las celdas de la tabla
  const tableDateElements = document.querySelectorAll(
      "td span.text-secondary"
  );
  tableDateElements.forEach((element) => {
      element.style.color = "#fff"; // Cambia esto al color original de tus fechas en modo oscuro
  });

  // Restaura el color original de los enlaces de las páginas
  const pageLinkElements = document.querySelectorAll(".page-link");
  pageLinkElements.forEach((element) => {
      element.style.color = ""; // Deja que los estilos originales se apliquen
  });

  const selectElements = document.querySelectorAll("select");
  selectElements.forEach((select) => {
      select.style.color = "#fff"; // Cambia esto al color deseado
      const optionElements = select.querySelectorAll("option");
      optionElements.forEach((option) => {
          option.style.color = "#fff"; // Cambia esto al color deseado
      });
  });

  const pencil = document.querySelectorAll(".fa-pencil-alt");
  pencil.forEach((element) => {
      pencil.classList.remove("text-secondary");
      pencil.style.setProperty("color", "#fff", "important");
  });
}

function setKidTheme() {
  // Restaura el color original de todos los elementos en el cuerpo, incluyendo navbar y sidebar
  const allTextElements = document.querySelectorAll("*");
  allTextElements.forEach((element) => {
      element.style.color = "#fff";
  });

  // Restaura el color original de los iconos dentro de .nav-item.active .icon i
  const navIconElements = document.querySelectorAll(
      ".nav-item.active .icon i"
  );
  navIconElements.forEach((element) => {
      element.style.color = "#fff"; // Cambia esto al color original de tus íconos en modo oscuro
  });

  // Restaura el color original de los iconos
  const iconElements = document.querySelectorAll(".nav-link .icon i");
  iconElements.forEach((element) => {
      element.style.color = "#1d365d"; // Cambia esto al color original de tus iconos
  });

  // Aplica la clase text-white solo a los iconos de Font Awesome dentro de las celdas de la tabla
  const tableIconElements = document.querySelectorAll("td .fas");
  tableIconElements.forEach((icon) => {
      icon.classList.add("text-white");
      icon.classList.remove("text-secondary");
  });



  // Restaura el color original de las fechas dentro de las celdas de la tabla
  const tableDateElements = document.querySelectorAll(
      "td span.text-secondary"
  );
  tableDateElements.forEach((element) => {
      element.style.color = "#fff"; // Cambia esto al color original de tus fechas en modo oscuro
  });

  // Restaura el color original de los enlaces de las páginas
  const pageLinkElements = document.querySelectorAll(".page-link");
  pageLinkElements.forEach((element) => {
      element.style.color = ""; // Deja que los estilos originales se apliquen
  });

  const selectElements = document.querySelectorAll("select");
  selectElements.forEach((select) => {
      select.style.color = "#fff"; // Cambia esto al color deseado
      const optionElements = select.querySelectorAll("option");
      optionElements.forEach((option) => {
          option.style.color = "#fff"; // Cambia esto al color deseado
      });
  });

  const pencil = document.querySelectorAll(".fa-pencil-alt");
  pencil.forEach((element) => {
      pencil.classList.remove("text-secondary");
      pencil.style.setProperty("color", "#fff", "important");
  });
}

function setYoungTheme() {
 // Restaura el color original de todos los elementos en el cuerpo, incluyendo navbar y sidebar
 const allTextElements = document.querySelectorAll("*");
 allTextElements.forEach((element) => {
     element.style.color = "#fff";
 });

 // Restaura el color original de los iconos dentro de .nav-item.active .icon i
 const navIconElements = document.querySelectorAll(
     ".nav-item.active .icon i"
 );
 navIconElements.forEach((element) => {
     element.style.color = "#fff"; // Cambia esto al color original de tus íconos en modo oscuro
 });

 // Restaura el color original de los iconos
 const iconElements = document.querySelectorAll(".nav-link .icon i");
 iconElements.forEach((element) => {
     element.style.color = "#1d365d"; // Cambia esto al color original de tus iconos
 });

 // Aplica la clase text-white solo a los iconos de Font Awesome dentro de las celdas de la tabla
 const tableIconElements = document.querySelectorAll("td .fas");
 tableIconElements.forEach((icon) => {
     icon.classList.add("text-white");
     icon.classList.remove("text-secondary");
 });



 // Restaura el color original de las fechas dentro de las celdas de la tabla
 const tableDateElements = document.querySelectorAll(
     "td span.text-secondary"
 );
 tableDateElements.forEach((element) => {
     element.style.color = "#fff"; // Cambia esto al color original de tus fechas en modo oscuro
 });

 // Restaura el color original de los enlaces de las páginas
 const pageLinkElements = document.querySelectorAll(".page-link");
 pageLinkElements.forEach((element) => {
     element.style.color = ""; // Deja que los estilos originales se apliquen
 });

 const selectElements = document.querySelectorAll("select");
 selectElements.forEach((select) => {
     select.style.color = "#fff"; // Cambia esto al color deseado
     const optionElements = select.querySelectorAll("option");
     optionElements.forEach((option) => {
         option.style.color = "#fff"; // Cambia esto al color deseado
     });
 });

 const pencil = document.querySelectorAll(".fa-pencil-alt");
 pencil.forEach((element) => {
     pencil.classList.remove("text-secondary");
     pencil.style.setProperty("color", "#fff", "important");
 });
}

function setAdultTheme() {
  // Restaura el color original de todos los elementos en el cuerpo, incluyendo navbar y sidebar
  const allTextElements = document.querySelectorAll("*");
  allTextElements.forEach((element) => {
      element.style.color = "#fff";
  });

  // Restaura el color original de los iconos dentro de .nav-item.active .icon i
  const navIconElements = document.querySelectorAll(
      ".nav-item.active .icon i"
  );
  navIconElements.forEach((element) => {
      element.style.color = "#fff"; // Cambia esto al color original de tus íconos en modo oscuro
  });

  // Restaura el color original de los iconos
  const iconElements = document.querySelectorAll(".nav-link .icon i");
  iconElements.forEach((element) => {
      element.style.color = "#1d365d"; // Cambia esto al color original de tus iconos
  });

  // Aplica la clase text-white solo a los iconos de Font Awesome dentro de las celdas de la tabla
  const tableIconElements = document.querySelectorAll("td .fas");
  tableIconElements.forEach((icon) => {
      icon.classList.add("text-white");
      icon.classList.remove("text-secondary");
  });



  // Restaura el color original de las fechas dentro de las celdas de la tabla
  const tableDateElements = document.querySelectorAll(
      "td span.text-secondary"
  );
  tableDateElements.forEach((element) => {
      element.style.color = "#fff"; // Cambia esto al color original de tus fechas en modo oscuro
  });

  // Restaura el color original de los enlaces de las páginas
  const pageLinkElements = document.querySelectorAll(".page-link");
  pageLinkElements.forEach((element) => {
      element.style.color = ""; // Deja que los estilos originales se apliquen
  });

  const selectElements = document.querySelectorAll("select");
  selectElements.forEach((select) => {
      select.style.color = "#fff"; // Cambia esto al color deseado
      const optionElements = select.querySelectorAll("option");
      optionElements.forEach((option) => {
          option.style.color = "#fff"; // Cambia esto al color deseado
      });
  });

  const pencil = document.querySelectorAll(".fa-pencil-alt");
  pencil.forEach((element) => {
      pencil.classList.remove("text-secondary");
      pencil.style.setProperty("color", "#fff", "important");
  });
}

function setPage(theme) {
    page.classList.remove(...Object.values(themeClasses));
    page.classList.add(themeClasses[theme]);
  }


function setThemeAndStyles(theme) {
  setTheme(theme);
  setPage(theme);

  switch (theme) {
    case 0: // light
      setNormalText();
      break;
    case 1: // dark
    setDarkTheme();
      break;
    case 2: // kid
      setKidTheme();
      break;
    case 3: // young
      setYoungTheme();
      break;
    case 4: // adult
      setAdultTheme();
      break;
    default:
      break;
  }

}

function isNight() {
  const now = new Date();
  const hours = now.getHours();
  const isNight = hours < 6 || hours >= 18;
  console.log(`Current time: ${hours}h, isNight: ${isNight}`);
  return isNight;
}

// Lógica inicial para establecer el tema según la hora del usuario si no hay ningún estilo definido
if (currentTheme == null || currentTheme == undefined) {
  if (isNight()) {
    setThemeAndStyles(1); // dark
  } else {
    setThemeAndStyles(0); // light
  }
  currentTheme = localStorage.getItem("theme");
  console.log(`Initial theme set: ${currentTheme}`);
}

setPage(currentTheme);

// Agregar event listeners a los botones de categoría
categoryButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const theme = button.getAttribute("data-theme");
      setThemeAndStyles(theme);
    });
  });

// Llama a la función para establecer el color al cargar la página
setThemeAndStyles(currentTheme);
