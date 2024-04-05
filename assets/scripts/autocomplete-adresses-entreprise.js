"use strict";

var addressCount = 1;

document.addEventListener("DOMContentLoaded", () => {
  initButtons();
  addressCount = document.querySelectorAll(".adresse-cp-entreprise").length;
  loadGoogleMaps()
    .then(() => {
      initMap();
    })
    .catch((error) => {
      console.error("Erreur de chargement de l'API Google Maps :", error);
    });
});

const CONFIGURATION = {
  mapsApiKey: "AIzaSyAgxHvp2OvCHEjca05FzbQRJGz9b7Z27Dc",
  capabilities: {
    addressAutocompleteControl: true,
  },
};

const ADDRESS_COMPONENT_TYPES_IN_FORM = [
  "adresse",
  "street_number",
  "locality",
  "administrative_area_level_1",
  "postal_code",
];

function getFormInputElement(componentType, inputNumber) {
  const inputElements = document.querySelectorAll(`input[name^="${componentType}-entreprise[${inputNumber}]"]`);
  return Array.from(inputElements);
}

function fillInAddress(place, inputNumber) {
  function getComponentName(componentType) {
    for (const component of place.address_components || []) {
      if (component.types[0] === componentType) {
        return component.long_name;
      }
    }
    return "";
  }

  function getComponentText(componentType) {
    if (componentType === "adresse") {
      const route = getComponentName("route");
      return `${route}`;
    } else {
      return getComponentName(componentType);
    }
  }

  for (const componentType of ADDRESS_COMPONENT_TYPES_IN_FORM) {
    const formInputs = getFormInputElement(componentType, inputNumber);
    formInputs.forEach((input) => {
      if (componentType === "adresse") {
        input.value = getComponentText("route"); // Autocomplete seulement pour le nom de rue
      } else {
        input.value = getComponentText(componentType);
      }
    });
  }
}


async function initMap() {
  const { Autocomplete } = google.maps.places;

  const autocompleteSections = document.querySelectorAll('.adresse-cp-entreprise');

  autocompleteSections.forEach((section, index) => {
    const inputElement = section.querySelector('input[type="text"]:first-of-type');
    const inputNumber = index + 1;

    const autocomplete = new Autocomplete(inputElement, {
      fields: ["address_components", "geometry", "name"],
      types: ["address"],
    });
    autocomplete.setComponentRestrictions({
      country: ["fr"],
    });

    autocomplete.addListener("place_changed", () => {
      const place = autocomplete.getPlace();
      if (!place.geometry) {
        window.alert(`Erreur pour : '${place.name}'`);
        return;
      }
      fillInAddress(place, inputNumber);
    });
  });
}

function addAddress() {
  const adresseCpEntreprise = document.querySelector(".adresse-cp-entreprise").cloneNode(true);
  const villeRegionEntreprise = document.querySelector(".ville-region-entreprise").cloneNode(true);

  addressCount++;

  const inputsToUpdate = adresseCpEntreprise.querySelectorAll("input");
  inputsToUpdate.forEach((input) => {
    input.value = "";
    const inputName = input.getAttribute("name");
    input.setAttribute("name", inputName.replace(/\[\d+\]/, `[${addressCount}]`));
    input.id = input.id.replace(/-\d+$/, `-${addressCount}`);
  });

  const labelsToUpdate = adresseCpEntreprise.querySelectorAll("label");
  labelsToUpdate.forEach((label) => {
    const inputId = label.getAttribute("for");
    if (inputId) {
      const updatedInputId = inputId.replace(/-\d+$/, `-${addressCount}`);
      label.setAttribute("for", updatedInputId);
    }
  });

  const inputsToUpdateRegion = villeRegionEntreprise.querySelectorAll("input");
  inputsToUpdateRegion.forEach((input) => {
    input.value = "";
    const inputName = input.getAttribute("name");
    input.setAttribute("name", inputName.replace(/\[\d+\]/, `[${addressCount}]`));
    input.id = input.id.replace(/-\d+$/, `-${addressCount}`);
  });

  const labelsToUpdateVille = villeRegionEntreprise.querySelectorAll("label");
  labelsToUpdateVille.forEach((label) => {
    const inputId = label.getAttribute("for");
    if (inputId) {
      const updatedInputId = inputId.replace(/-\d+$/, `-${addressCount}`);
      label.setAttribute("for", updatedInputId);
    }
  });

  const ajouterAdresse = document.querySelector("#ajouter-adresse");

  var BtnSupprAdresse = document.querySelector("#suppr-adresse");
  if (!BtnSupprAdresse) {
    ajouterAdresse.insertAdjacentHTML(
      "beforeend",
      `
    <button type="button" id="suppr-adresse">Supprimer la dernière adresse</button>
    `
    );

    BtnSupprAdresse = document.querySelector("#suppr-adresse");
    BtnSupprAdresse.addEventListener("click", removeLastAddress);
  }

  const hr = document.createElement("hr");
  hr.classList.add("adresse-separator");
  ajouterAdresse.parentNode.insertBefore(hr, ajouterAdresse);
  ajouterAdresse.parentNode.insertBefore(adresseCpEntreprise, ajouterAdresse);
  ajouterAdresse.parentNode.insertBefore(villeRegionEntreprise, ajouterAdresse);

  initMap();
}

function removeLastAddress() {
  var adressesSupplementaires = document.querySelectorAll(
    ".adresse-cp-entreprise"
  );
  var villesRegionsSupplementaires = document.querySelectorAll(
    ".ville-region-entreprise"
  );
  var hr = document.querySelectorAll(".adresse-separator");

  if (
    adressesSupplementaires.length > 1 &&
    villesRegionsSupplementaires.length > 1 &&
    hr.length > 0
  ) {
    var derniereAdresse =
      adressesSupplementaires[adressesSupplementaires.length - 1];
    var derniereVilleRegion =
      villesRegionsSupplementaires[villesRegionsSupplementaires.length - 1];
    var hr = hr[hr.length - 1];
    var pacContainers = document.querySelectorAll("div.pac-container");

    derniereAdresse.remove();
    derniereVilleRegion.remove();
    hr.remove();

    if (pacContainers.length >= 4) {
      pacContainers[pacContainers.length - 1].remove();
      pacContainers[pacContainers.length - 2].remove();
    }
    addressCount--;
  }

  var adressesSupplementaires = document.querySelectorAll(
    ".adresse-cp-entreprise"
  );
  var villesRegionsSupplementaires = document.querySelectorAll(
    ".ville-region-entreprise"
  );
  var hr = document.querySelectorAll(".adresse-separator");

  if (
    adressesSupplementaires.length == 1 &&
    villesRegionsSupplementaires.length == 1 &&
    hr.length == 0
  ) {
    document.querySelector("#suppr-adresse").remove();
  }
}

function initButtons() {
  const boutonAjouterAdresse = document.getElementById("btn-ajouter-adresse");
  boutonAjouterAdresse.addEventListener("click", addAddress);

  const boutonSupprAdresse = document.getElementById("suppr-adresse");
  if (boutonSupprAdresse) {
    boutonSupprAdresse.addEventListener("click", removeLastAddress);
  }
}

function loadGoogleMaps() {
  return new Promise((resolve, reject) => {
    const script = document.createElement("script");
    script.src = `https://maps.googleapis.com/maps/api/js?key=${CONFIGURATION.mapsApiKey}&libraries=places,marker&callback=initMap&solution_channel=GMP_QB_addressselection_v2_cA`;
    script.async = true;
    script.defer = true;
    script.onerror = reject;
    document.head.appendChild(script);
    script.onload = resolve;
  });
}
