<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Portfolio - ELYSSA'S STUDIO</title>
    <link rel="stylesheet" href="styles/style6.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="portfolio.html">Portfolio</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <div class="portfolio-section">
        <h2>Our Portfolio</h2>

        <!-- Add Track Button (Visible to Artists/Admins) -->
        <button id="add-track-btn">Add Track</button>

        <!-- Carousel Container -->
        <div class="carousel-container">
            <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
            <div class="carousel" id="trackList">
                <!-- Tracks will be dynamically inserted here -->
            </div>
            <button class="next" onclick="moveSlide(1)">&#10095;</button>
        </div>
    </div>

    <!-- Add Track Modal -->
    <div id="track-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add Track</h2>
            <form id="addTrackForm">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" required>
                <label for="artiste_id">Artiste:</label>
                <select id="artiste_id" name="artiste_id" required>
                    <!-- Artistes will be dynamically inserted here -->
                </select>
                <button type="submit">Add Track</button>
            </form>
        </div>
    </div>

    <script>
        // Carousel Logic
        let index = 0;
        function moveSlide(step) {
            const slides = document.querySelectorAll('.portfolio-item');
            index = (index + step + slides.length) % slides.length;
            document.querySelector('.carousel').style.transform = `translateX(${-index * 100}%)`;
        }

        // Modal Logic
        const modal = document.getElementById('track-modal');
        const addTrackBtn = document.getElementById('add-track-btn');
        const closeBtn = document.querySelector('.close');

        addTrackBtn.addEventListener('click', () => {
            modal.style.display = 'block';
        });

        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });

        // Load Tracks and Artistes on Page Load
        document.addEventListener('DOMContentLoaded', function () {
            loadTracks();
            loadArtistes();
        });

        // Fetch and Display Tracks
        function loadTracks() {
            fetch('tracksController.php?action=getTracks')
                .then(response => response.json())
                .then(data => {
                    const trackList = document.getElementById('trackList');
                    trackList.innerHTML = '';
                    data.data.forEach(track => {
                        const trackDiv = document.createElement('div');
                        trackDiv.classList.add('portfolio-item');
                        trackDiv.innerHTML = `
                            <h3>${track.title} - ${track.artiste}</h3>
                            <p class="price">$${track.price}</p>
                            <button onclick="deleteTrack(${track.id})">Delete</button>
                        `;
                        trackList.appendChild(trackDiv);
                    });
                })
                .catch(error => console.error('Error loading tracks:', error));
        }

        // Fetch and Display Artistes
        function loadArtistes() {
            fetch('tracksController.php?action=getArtistes')
                .then(response => response.json())
                .then(data => {
                    const artisteSelect = document.getElementById('artiste_id');
                    artisteSelect.innerHTML = '';
                    data.data.forEach(artiste => {
                        const option = document.createElement('option');
                        option.value = artiste.id;
                        option.textContent = artiste.nom;
                        artisteSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error loading artistes:', error));
        }

        // Add Track
        document.getElementById('addTrackForm').addEventListener('submit', function (event) {
            event.preventDefault();
            const title = document.getElementById('title').value;
            const price = document.getElementById('price').value;
            const artiste_id = document.getElementById('artiste_id').value;

            fetch('tracksController.php', {
                method: 'POST',
                body: new URLSearchParams({ action: 'addTrack', title, price, artiste_id }),
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.success) {
                    loadTracks();
                    modal.style.display = 'none';
                    document.getElementById('addTrackForm').reset();
                }
            })
            .catch(error => console.error('Error:', error));
        });

        // Delete Track
        function deleteTrack(id) {
            if (confirm('Are you sure you want to delete this track?')) {
                fetch('tracksController.php', {
                    method: 'POST',
                    body: new URLSearchParams({ action: 'deleteTrack', id }),
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    if (data.success) loadTracks();
                })
                .catch(error => console.error('Error:', error));
            }
        }
    </script>
</body>
</html>