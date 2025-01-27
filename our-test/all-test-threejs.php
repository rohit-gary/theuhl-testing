<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>3D Product View</title>

  <!-- Required Libraries -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/examples/js/controls/OrbitControls.js"></script>

  <style>
    body {
      margin: 0;
      overflow: hidden;
    }

    #product-viewer {
      width: 100vw;
      height: 100vh;
    }

    .controls {
      position: fixed;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 100;
      background: rgba(255, 255, 255, 0.1);
      padding: 10px;
      border-radius: 10px;
      backdrop-filter: blur(5px);
    }

    .control-btn {
      padding: 8px 15px;
      margin: 0 5px;
      border: none;
      border-radius: 5px;
      background: #2196F3;
      color: white;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .control-btn:hover {
      background: #1976D2;
    }
  </style>
</head>

<body>
  <div id="product-viewer"></div>
  <div class="controls">
    <button class="control-btn" onclick="resetView()">Reset View</button>
    <button class="control-btn" onclick="toggleAutoRotate()">Auto Rotate</button>
  </div>

  <script>
    let scene, camera, renderer, controls;
    let productMesh;
    let autoRotate = false;

    // Image URLs for different sides of the product
    const imageUrls = {
      front: 'https://example.com/path-to-your-image/front.jpg',
      back: 'https://example.com/path-to-your-image/back.jpg',
      left: 'https://example.com/path-to-your-image/left.jpg',
      right: 'https://example.com/path-to-your-image/right.jpg',
      top: 'https://example.com/path-to-your-image/top.jpg',
      bottom: 'https://example.com/path-to-your-image/bottom.jpg'
    };

    // Initialize the scene
    function init() {
      // Create scene
      scene = new THREE.Scene();
      scene.background = new THREE.Color(0x000000);

      // Create camera
      camera = new THREE.PerspectiveCamera(
        75,
        window.innerWidth / window.innerHeight,
        0.1,
        1000
      );
      camera.position.z = 5;

      // Create renderer
      renderer = new THREE.WebGLRenderer({ antialias: true });
      renderer.setSize(window.innerWidth, window.innerHeight);
      document.getElementById('product-viewer').appendChild(renderer.domElement);

      // Add controls
      controls = new THREE.OrbitControls(camera, renderer.domElement);
      controls.enableDamping = true;
      controls.dampingFactor = 0.05;

      // Add lights
      addLights();

      // Create product visualization
      createProduct();

      // Start animation
      animate();

      // Handle window resize
      window.addEventListener('resize', onWindowResize, false);
    }

    function addLights() {
      // Ambient light
      const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
      scene.add(ambientLight);

      // Directional light
      const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
      directionalLight.position.set(1, 1, 1);
      scene.add(directionalLight);

      // Point lights for better illumination
      const pointLight1 = new THREE.PointLight(0xffffff, 0.5);
      pointLight1.position.set(2, 2, 2);
      scene.add(pointLight1);

      const pointLight2 = new THREE.PointLight(0xffffff, 0.5);
      pointLight2.position.set(-2, -2, -2);
      scene.add(pointLight2);
    }

    function createProduct() {
      // Create a box geometry to display images on each face
      const geometry = new THREE.BoxGeometry(2, 2, 2);

      // Load textures for each side
      const textureLoader = new THREE.TextureLoader();
      const materials = [
        new THREE.MeshPhongMaterial({ map: textureLoader.load(imageUrls.right) }),
        new THREE.MeshPhongMaterial({ map: textureLoader.load(imageUrls.left) }),
        new THREE.MeshPhongMaterial({ map: textureLoader.load(imageUrls.top) }),
        new THREE.MeshPhongMaterial({ map: textureLoader.load(imageUrls.bottom) }),
        new THREE.MeshPhongMaterial({ map: textureLoader.load(imageUrls.front) }),
        new THREE.MeshPhongMaterial({ map: textureLoader.load(imageUrls.back) })
      ];

      // Create mesh
      productMesh = new THREE.Mesh(geometry, materials);
      scene.add(productMesh);

      // Add simple animation
      productMesh.rotation.y = Math.PI / 4;
    }

    function animate() {
      requestAnimationFrame(animate);

      if (autoRotate && productMesh) {
        productMesh.rotation.y += 0.01;
      }

      controls.update();
      renderer.render(scene, camera);
    }

    function onWindowResize() {
      camera.aspect = window.innerWidth / window.innerHeight;
      camera.updateProjectionMatrix();
      renderer.setSize(window.innerWidth, window.innerHeight);
    }

    // Control functions
    function resetView() {
      if (productMesh) {
        productMesh.rotation.set(0, Math.PI / 4, 0);
        camera.position.set(0, 0, 5);
        controls.reset();
      }
    }

    function toggleAutoRotate() {
      autoRotate = !autoRotate;
    }

    // Initialize everything
    init();
  </script>
</body>

</html>