/*!

=========================================================
* Soft UI Dashboard Tailwind - v1.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard-tailwind
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (site.license)

* Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

*/
var page = window.location.pathname.split(`/`).pop().split(`.`)[0];
let url =  window.location.origin;
var aux = window.location.pathname.split(`/`);
var to_build = (aux.includes('pages')?'../':'./');
var root = window.location.pathname.split(`/`)
if (!aux.includes(`pages`)) {
  page = `dashboard`;
}

loadStylesheet(`${url}/css/perfect-scrollbar.css`); 
loadJS(`${url}/js/perfect-scrollbar.js`, true);

if (document.querySelector(`nav [navbar-trigger]`)) {
  loadJS(`${url}/js/navbar-collapse.js`, true);
}

if (document.querySelector(`[data-target='tooltip']`)) {
  loadJS(`${url}/js/tooltips.js`, true);
  loadStylesheet(`${url}/css/tooltips.css`);
}

if (document.querySelector(`[nav-pills]`)) {
  loadJS(`${url}/js/nav-pills.js`, true);
}

if (document.querySelector(`[dropdown-trigger]`)) {
  loadJS(`${url}/js/dropdown.js`, true);

}

if (document.querySelector(`[fixed-plugin]`)) {
  loadJS(`${url}/js/fixed-plugin.js`, true);
}

if (document.querySelector(`[navbar-main]`)) {
  loadJS(`${url}/js/sidenav-burger.js`, true);
  loadJS(`${url}/js/navbar-sticky.js`, true);
}

if (document.querySelector(`canvas`)) {
  loadJS(`${url}/js/chart-1.js`, true);
  loadJS(`${url}/js/chart-2.js`, true);
}

function loadJS(FILE_URL, async) {
  let dynamicScript = document.createElement(`script`);

  dynamicScript.setAttribute(`src`, FILE_URL);
  dynamicScript.setAttribute(`type`, `text/javascript`);
  dynamicScript.setAttribute(`async`, async);

  document.head.appendChild(dynamicScript);
}

function loadStylesheet(FILE_URL) {
  let dynamicStylesheet = document.createElement(`link`);

  dynamicStylesheet.setAttribute(`href`, FILE_URL);
  dynamicStylesheet.setAttribute(`type`, `text/css`);
  dynamicStylesheet.setAttribute(`rel`, `stylesheet`);

  document.head.appendChild(dynamicStylesheet);
}
