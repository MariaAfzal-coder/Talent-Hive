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
