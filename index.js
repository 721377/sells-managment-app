let arrowmove1 = "arrowmove1";
let arrowmove2 = "arrowmove1";
let commandes = "InterventionsMove1";
let InterventionsMove = "InterventionsMove1";
let sidmove = "sid1";
let logomove = "imgmove1";

let arrow_visibility = "arrowshow";
let inter = "inter1";

function handelsidemove() {
  if (window.innerWidth < 737) {
    if (sidmove === "sid1") {
      sidmove = "sid2";
      logomove = "imgmove2";
      arrow_visibility = "arrowshow";
      inter = "inter1";
    } else {
      sidmove = "sid1";
      logomove = "imgmove1";
      arrow_visibility = "arrowshow";
      inter = "inter2";
    }
  } else {
    if (sidmove === "sid1") {
      sidmove = "sid2";
      logomove = "imgmove2";
      arrow_visibility = "arrowhide";
      inter = "inter2";
    } else {
      sidmove = "sid1";
      logomove = "imgmove1";
      arrow_visibility = "arrowshow";
      inter = "inter1";
    }
  }

  // Update the DOM elements with the new class names or values as needed
  document.querySelector(".sidbar").className = `sidbar ${sidmove}`;
  document.querySelector(".logo").className = `logo ${logomove}`;
  document.querySelector(
    ".arrow1"
  ).className = `arrow1 ${arrow_visibility} ${arrowmove1}`;
  document.querySelector(
    ".arrow2"
  ).className = `arrow2 ${arrow_visibility} ${arrowmove2}`;
  document.querySelector(
    ".Interventions"
  ).className = `Interventions ${InterventionsMove}`;
  document.querySelector(".commandes").className = `commandes ${commandes}`;

  // Add logic to update other elements as needed
}

function handelarrowmove1() {
  if (arrowmove1 === "arrowmove1") {
    arrowmove1 = "arrowmove2";
    InterventionsMove = "InterventionsMove2";
    arrowmove2 = "arrowmove1";
    commandes = "InterventionsMove1";
  } else {
    arrowmove1 = "arrowmove1";
    InterventionsMove = "InterventionsMove1";
  }

  document.querySelector(
    ".arrow1"
  ).className = ` arrow1 ${arrow_visibility} ${arrowmove1}`;
  document.querySelector(
    ".Interventions"
  ).className = `Interventions ${InterventionsMove}`;

  document.querySelector(
    ".arrow2"
  ).className = ` arrow2 ${arrow_visibility} ${arrowmove2}`;
  document.querySelector(".commandes").className = `commandes ${commandes}`;
}

function handelarrowmove2() {
  if (arrowmove2 === "arrowmove1") {
    arrowmove2 = "arrowmove2";
    commandes = "InterventionsMove2";
    arrowmove1 = "arrowmove1";
    InterventionsMove = "InterventionsMove1";
  } else {
    arrowmove2 = "arrowmove1";
    commandes = "InterventionsMove1";
  }

  document.querySelector(
    ".arrow2"
  ).className = ` arrow2 ${arrow_visibility} ${arrowmove2}`;
  document.querySelector(".commandes").className = `commandes ${commandes}`;

  document.querySelector(
    ".arrow1"
  ).className = ` arrow1 ${arrow_visibility} ${arrowmove1}`;
  document.querySelector(
    ".Interventions"
  ).className = `Interventions ${InterventionsMove}`;
}

function checkPageWidth() {
  if (window.innerWidth < 737) {
    handelsidemove();
  }
}

// Initialize the page with the initial values
handelsidemove();
