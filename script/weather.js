  // Fetch weather data from an API (Replace API_KEY with your actual API key)
  const apiKey = 'e9b510712c65fcf24d71f7d571935a7d';
  
  // Get user's current position
  navigator.geolocation.getCurrentPosition(success, error);
  
  function success(position) {
    const latitude = position.coords.latitude;
    const longitude = position.coords.longitude;
    
    // Fetch weather data using user's coordinates
    const apiUrl = `https://api.openweathermap.org/data/2.5/weather?lat=${latitude}&lon=${longitude}&units=metric&appid=${apiKey}`;
    
    fetch(apiUrl)
      .then(response => response.json())
      .then(data => {
        const locationName = data.name;
        const temperature = data.main.temp;
        const weatherDescription = data.weather[0].description;
        const windSpeed = data.wind.speed;
        const humidity = data.main.humidity;
        const weatherIcon = data.weather[0].icon; // Icon code from API response

        // Update location name
        const locationNameElement = document.getElementById('location-name');
        locationNameElement.textContent = locationName;

        // Update current time (if available)
        const currentTimeElement = document.getElementById('current-time');
        currentTimeElement.textContent = getCurrentTime();

        // Update weather description in the card
        const weatherDescriptionElement = document.getElementById('weather-description');
        weatherDescriptionElement.textContent = weatherDescription;

        // Update weather details in the card
        const weatherDetails = document.getElementById('weather-details');
        weatherDetails.innerHTML = `
          <div><i class="fas fa-wind fa-fw" style="color: #868B94;"></i> ${windSpeed} km/h</div>
          <div><i class="fas fa-tint fa-fw" style="color: #868B94;"></i> ${humidity}%</div>
          <div><i class="fas fa-sun fa-fw" style="color: #868B94;"></i> ${weatherDescription}</div>
        `;

        // Update temperature in the card
        const temperatureElement = document.querySelector('.display-4');
        temperatureElement.textContent = `${temperature}°C`;
        
        // Update weather icon
        const weatherIconElement = document.getElementById('weather-icon');
        weatherIconElement.src = `http://openweathermap.org/img/w/${weatherIcon}.png`;
      })
      .catch(error => {
        console.error('Error fetching weather data:', error);
      });
  }
  
  function error() {
    console.error('Unable to retrieve location.');
  }

  // Function to get the current time
  function getCurrentTime() {
    const now = new Date();
    let hours = now.getHours();
    const minutes = now.getMinutes();
    const ampm = hours >= 12 ? 'PM' : 'AM';
    
    // Convert hours to 12-hour format
    hours = hours % 12 || 12;
    
    return `${hours}:${minutes < 10 ? '0' : ''}${minutes} ${ampm}`;
  }
  
