// Función para los temas claro/oscuro
const colorSwitch = document.querySelector('#switch input[type="checkbox"]');
function cambiaTema(ev) {
  if (ev.target.checked) {
    document.documentElement.setAttribute('tema', 'dark');
  } else {
    document.documentElement.setAttribute('tema', 'light');
  }
}
colorSwitch.addEventListener('change', cambiaTema);

// Función para el formulario
!function () {
  function check(e) {
    if (e.target.value !== '') {
      return e.target.style.paddingBottom = "1em";
    }

    e.target.style.paddingBottom = "0";
  }

  function send(e) {
    e.preventDefault()

    this.reset()
  }

  form.addEventListener("keyup", check);
  form.addEventListener("submit", send);
}();