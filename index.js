fetch('projects.php')
    .then(response => response.json())
    .then(projectsData => {
        projectsData.forEach(project => {
            project.technology_used = project.technology_used.split(',');
        });
        const projectsContainer = document.getElementById('projectsContainer');

    // Load the real values
    const projectsCompleted = projectsData.length;
    const technologiesMastered = Array.from(new Set(projectsData.flatMap(project => project.technology_used))).length;
    const hoursDedicated = projectsData.reduce((totalHours, project) => totalHours + parseInt(project.working_hours), 0);

    // Update the HTML elements with the real values
    const projectsCompletedElement = document.getElementById("projectsCompleted");
    const technologiesMasteredElement = document.getElementById("technologiesMastered");
    const hoursDedicatedElement = document.getElementById("hoursDedicated");

    projectsCompletedElement.textContent = projectsCompleted.toString();
    technologiesMasteredElement.textContent = technologiesMastered.toString();
    hoursDedicatedElement.textContent = hoursDedicated.toString();

    // Loop through the data and create project cards dynamically.
    projectsData.forEach(project => {
      const projectCard = `
        <article class="relative isolate flex flex-col justify-end overflow-hidden rounded-2xl bg-gray-900 px-8 pb-8 pt-80 sm:pt-48 lg:pt-80">
          <img src="${project.imageSrc}" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover" />
          <div class="absolute inset-0 -z-10 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>
          <div class="absolute inset-0 -z-10 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
          <div class="flex flex-wrap items-center gap-y-1 overflow-hidden text-sm leading-6 text-gray-300">
            <time datetime="2020-03-16" class="mr-8">Mar 16, 2020</time>
            <div class="-ml-4 flex items-center gap-x-4">
              <svg viewBox="0 0 2 2" class="-ml-0.5 h-0.5 w-0.5 flex-none fill-white/50">
                <circle cx="1" cy="1" r="1"></circle>
              </svg>
              <div class="flex gap-x-2.5">
                <img src="images/myphotos/orProfile.JPG" alt="" class="h-6 w-6 flex-none rounded-full bg-white/10" />
                Or Basker
              </div>
            </div>
          </div>
          <h3 class="mt-3 text-lg font-semibold leading-6 text-white">
            <a href="${project.link}" target="blank">
              <span class="absolute inset-0"></span>
              ${project.title}
            </a>
          </h3>
        </article>
      `;

      projectsContainer.innerHTML += projectCard;
    });
    });




  
  function displaySuccessMessage(message) {
   
    const successMessage = document.getElementById("successMessage");
    successMessage.textContent = message;
    successMessage.classList.remove("hidden");

    setTimeout(() => {
        successMessage.classList.add("hidden");
    }, 5000);

    // You can customize additional styling or animations here if desired
  }
  
  function displayErrorMessage(message) {
    const errorMessage = document.getElementById("errorMessage");
    errorMessage.textContent = message;
    errorMessage.classList.remove("hidden");

    setTimeout(() => {
        errorMessage.classList.add("hidden");
    }, 5000);
    // You can customize additional styling or animations here if desired
  }
  
  function scrollToContactForm() {
    // const contactForm = document.getElementById('contactForm');
    const contactMe = document.getElementById('contactMe');
    contactMe.scrollIntoView({ behavior: 'smooth' });
  }

fetch('json/job_history.json')
    .then(response => response.json())
    .then(jobHistoryData => {
        let jobList = document.getElementById('jobList');

        // Loop through the JSON data and create the HTML elements for each item
        jobHistoryData.forEach(function(job) {
            let li = document.createElement('li');
            li.classList.add('mb-10', 'ml-4');
        
            let div = document.createElement('div');
            div.classList.add('absolute', 'w-3', 'h-3', 'bg-gray-200', 'rounded-full', 'mt-1.5', '-left-1.5', 'border', 'border-white', 'dark:border-gray-900', 'dark:bg-gray-700');
        
            let time = document.createElement('time');
            time.classList.add('mb-1', 'text-sm', 'font-normal', 'leading-none', 'text-gray-400', 'dark:text-gray-500');
            time.textContent = job.duration;
        
            let h3 = document.createElement('h3');
            h3.classList.add('text-lg', 'font-semibold', 'text-gray-900', 'dark:text-white');
            h3.textContent = job.position;
        
            let p = document.createElement('p');
            p.classList.add('text-base', 'font-normal', 'text-gray-500', 'dark:text-gray-400');
            p.textContent = job.responsibilities;
        
            li.append(div, time, h3, p);
            jobList.appendChild(li);
        });
    });  

window.onload = function() {
        fixedButton = document.getElementById('fixedButton');
        fixedButton.addEventListener('click', function() {
            scrollToContactForm();
        });



        let sentCounter = 0;
        document.getElementById("contactForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent form submission
        
        // Create a new FormData object
        let formData = new FormData(this);
        if (sentCounter > 0) {
            displayErrorMessage("you already sent the form");
            return;
        }
        // Send the form data to the server
        fetch("monday_handler.php", {
            method: "POST",
            body: formData
        })
            .then(response => {
            if (response.ok) {
                // Form submission successful
                displaySuccessMessage("very godd! i will keep in touch");
                sentCounter++;
            } else {
                throw new Error("Form submission failed");
            }
            })
            .catch(error => {
            console.error(error);
            // Display error message
            displayErrorMessage("form didnt submitted");
            });
        });
    };

    window.addEventListener('DOMContentLoaded', () => {
      const buttonContainer = document.querySelector('.button-container');
      const fixedButton = document.getElementById('fixedButton');
      const resumeButton = document.getElementById('resumeButton');
      
      let lastScrollPosition = window.scrollY;
    
      const checkScroll = () => {
        const currentScrollPosition = window.scrollY;
        
        if (currentScrollPosition > lastScrollPosition) {
          fixedButton.style.display = 'none';
          resumeButton.style.display = 'none';
        } else {
          fixedButton.style.display = 'block';
          resumeButton.style.display = 'block';
        }
        
        lastScrollPosition = currentScrollPosition;
      };
    
      checkScroll();
      window.addEventListener('scroll', checkScroll);
    });
    