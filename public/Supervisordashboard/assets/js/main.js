// Elements to inject
let mySVGsToInject = document.querySelectorAll('img.inject-svg');
if (mySVGsToInject) {
  // Do the injection
  SVGInjector(mySVGsToInject);
}

// JavaScript to handle sidebar toggle
const sidebarToggle = document.getElementById('sidebarToggle');
const sidebar = document.querySelector('.sidebar');
const dimBackground = document.getElementById('dimBackground');
const body = document.body;
if (sidebarToggle) {
  sidebarToggle.addEventListener('click', () => {
    if (sidebar.classList.contains('sidebar-open')) {
      sidebar.classList.remove('sidebar-open');
      dimBackground.classList.remove('active');
      body.style.marginRight = '0'; // Reset margin
      body.style.overflow = 'auto'; // Enable scrolling
    } else {
      sidebar.classList.add('sidebar-open');
      dimBackground.classList.add('active');
      body.style.overflow = 'hidden'; // Disable scrolling
      body.style.marginRight = getScrollbarWidth() + 'px'; // Add margin to compensate for scrollbar width
    }
  });

  dimBackground.addEventListener('click', () => {
    sidebar.classList.remove('sidebar-open');
    dimBackground.classList.remove('active');
    body.style.overflow = 'auto'; // Enable scrolling
    body.style.marginRight = '0'; // Reset margin
  });
}

function getScrollbarWidth() {
  const outer = document.createElement('div');
  outer.style.visibility = 'hidden';
  outer.style.overflow = 'scroll';
  document.body.appendChild(outer);

  const innerWidth = outer.clientWidth;
  outer.parentNode.removeChild(outer);
  return window.innerWidth - innerWidth;
}

const navbar = document.querySelector('.navbar');

if (navbar) {
  window.addEventListener('scroll', () => {
    if (window.scrollY > 50) { // Adjust the value as needed
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
  });
}

function getCssValue(element, property) {
  const computedStyle = window.getComputedStyle(element);
  const value = computedStyle.getPropertyValue(property);
  return value;
}

function getCssVariableValue(variableName) {
  const computedStyle = window.getComputedStyle(document.documentElement);
  const value = computedStyle.getPropertyValue(variableName).trim();
  return value;
}

document.querySelector('#open-messages-sidebar')?.addEventListener('click', () => {
  const messagesSidebar = document.querySelector('.messages-sidebar');
  if (messagesSidebar) {
    messagesSidebar.classList.add('show');
  }
})

document.querySelector('#close-messages-sidebar')?.addEventListener('click', () => {
  const messagesSidebar = document.querySelector('.messages-sidebar');
  if (messagesSidebar) {
    messagesSidebar.classList.remove('show');
  }
})

// Function to show increase, decrease, and save buttons and hide the update button
function showUpdateButtons(containerId) {
  // Find the button container
  const buttonContainer = document.getElementById(containerId);
  
  // Find the "Update Buttons" button and the other toggle buttons
  const updateButton = buttonContainer.querySelector('.show-buttons');
  const toggleButtons = buttonContainer.querySelectorAll('.toggle-button');

  // Hide the "Update Buttons" button
  updateButton.classList.add('hidden');

  // Show the increase, decrease, and save buttons
  toggleButtons.forEach(button => button.classList.remove('hidden'));
}

// Function to update the progress value
function updateProgress(studentId, change) {
  // Find the student card element by ID
  const studentCard = document.getElementById(studentId);
  
  // Find the progress bar and the progress value element within the student card
  const progressBar = studentCard.querySelector('.progress-bar .progress');
  const progressValueElement = studentCard.querySelector('.progress-value');

  // Get the current progress value from the text content of the progress value element
  let currentProgress = parseInt(progressValueElement.textContent);

  // Calculate the new progress value
  let newProgress = currentProgress + change;

  // Ensure the new progress is within the range of 0 to 100
  if (newProgress > 100) newProgress = 100;
  if (newProgress < 0) newProgress = 0;

  // Update the progress bar width and progress value element text
  progressBar.style.width = newProgress + '%';
  progressValueElement.textContent = newProgress + '%';
}

// Function to save the progress and hide the increase, decrease, and save buttons
function saveProgress(containerId) {
  // Find the button container
  const buttonContainer = document.getElementById(containerId);
  
  // Find the "Update Buttons" button and the other toggle buttons
  const updateButton = buttonContainer.querySelector('.show-buttons');
  const toggleButtons = buttonContainer.querySelectorAll('.toggle-button');

  // Hide the increase, decrease, and save buttons
  toggleButtons.forEach(button => button.classList.add('hidden'));

  // Show the "Update Buttons" button
  updateButton.classList.remove('hidden');

  // Additional logic can be added here to save the progress to a server or local storage if needed
}

