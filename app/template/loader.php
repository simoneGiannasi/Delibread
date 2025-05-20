<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bread Platypus Loader</title>
  <style>
    body {
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background-color: #f9d49f;
      font-family: Arial, sans-serif;
    }
    
    .loader-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 20px;
    }
    
    .loader {
      width: 200px;
      height: 200px;
      position: relative;
      animation: spin 3s infinite linear;
      transform-origin: center center;
    }
    
    .loader img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }
    
    .loading-text {
      font-size: 24px;
      color: #8B4513;
      font-weight: bold;
    }
    
    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }
      100% {
        transform: rotate(360deg);
      }
    }
    
    .controls {
      display: flex;
      gap: 10px;
    }
    
    button {
      padding: 8px 16px;
      background-color: #8B4513;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    
    button:hover {
      background-color: #a05c2c;
    }
  </style>
</head>
<body>
  <div class="loader-container">
    <div class="loader">
      <img src="./../assets/logo-nosfondo.png" alt="Bread Platypus" id="platypus-img">
    </div>
    <div class="loading-text">Loading...</div>
    <div class="controls">
      <button onclick="changeSpeed(1)">Slower</button>
      <button onclick="changeSpeed(-1)">Faster</button>
      <button onclick="toggleSpin()">Pause/Play</button>
    </div>
  </div>

  <script>
    // Since we can't use the actual uploaded image directly,
    // this would be the place where you'd set the actual image source
    // For now, we're using the placeholder
    
    let currentSpeed = 3;
    let isPaused = false;
    const loader = document.querySelector('.loader');
    
    function changeSpeed(change) {
      currentSpeed = Math.max(0.5, Math.min(5, currentSpeed + change));
      if (!isPaused) {
        loader.style.animation = `spin ${currentSpeed}s infinite linear`;
      }
    }
    
    function toggleSpin() {
      isPaused = !isPaused;
      if (isPaused) {
        const computedStyle = window.getComputedStyle(loader);
        const transform = computedStyle.getPropertyValue('transform');
        loader.style.animation = 'none';
        loader.style.transform = transform;
      } else {
        loader.style.animation = `spin ${currentSpeed}s infinite linear`;
        loader.style.transform = '';
      }
    }
  </script>
</body>
</html>