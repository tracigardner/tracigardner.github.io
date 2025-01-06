// Configuration: Set the number of tips and the file path
const totalTips = 3; // Total number of tip files (e.g., tip1.html to tip10.html)
const tipBasePath = "/TechComm/tips/"; // Path where tip files are stored (e.g., "tips/")

// Function to load a random tip
function loadRandomTip() {
  const randomTipNumber = Math.floor(Math.random() * totalTips) + 1; // Random number between 1 and totalTips
  const randomTipFile = `${tipBasePath}tip${randomTipNumber}.html`;

  // Fetch the content of the selected tip file
  fetch(randomTipFile)
    .then((response) => {
      if (!response.ok) {
        throw new Error(`Error fetching tip file: ${response.statusText}`);
      }
      return response.text();
    })
    .then((htmlContent) => {
      // Insert the content into the tip container
      const tipContainer = document.getElementById("tip-container");
      tipContainer.innerHTML = htmlContent;
    })
    .catch((error) => {
      console.error("Error loading the tip:", error);
      const tipContainer = document.getElementById("tip-container");
      tipContainer.innerHTML =
        "<p>Sorry, an error occurred while loading the tip.</p>";
    });
}

// Load a random tip when the page loads
document.addEventListener("DOMContentLoaded", loadRandomTip);
