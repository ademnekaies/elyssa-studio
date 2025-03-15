document.addEventListener("DOMContentLoaded", function () {
    loadTracks();
    loadArtistes();

    document.getElementById("addTrackForm").addEventListener("submit", function (event) {
        event.preventDefault();
        addTrack();
    });

    document.getElementById("addArtisteForm").addEventListener("submit", function (event) {
        event.preventDefault();
        addArtiste();
    });
});

function loadTracks() {
    fetch("TracksController.php?action=getTracks")
        .then(response => response.json())
        .then(data => {
            const trackList = document.getElementById("trackList");
            trackList.innerHTML = "";

            data.data.forEach(track => {
                const trackDiv = document.createElement("div");
                trackDiv.classList.add("portfolio-item");
                trackDiv.innerHTML = `
                    <h3>${track.title} - ${track.artiste}</h3>
                    <p class="price">$${track.price}</p>
                    <button onclick="deleteTrack(${track.id})">Supprimer</button>
                `;
                trackList.appendChild(trackDiv);
            });
        })
        .catch(error => console.error("Erreur lors du chargement des tracks:", error));
}

function loadArtistes() {
    fetch("TracksController.php?action=getArtistes")
        .then(response => response.json())
        .then(data => {
            const artisteSelect = document.getElementById("artiste_id");
            artisteSelect.innerHTML = "";
            data.data.forEach(artiste => {
                const option = document.createElement("option");
                option.value = artiste.id;
                option.textContent = artiste.nom;
                artisteSelect.appendChild(option);
            });
        })
        .catch(error => console.error("Erreur lors du chargement des artistes:", error));
}

function addTrack() {
    const title = document.getElementById("title").value;
    const price = document.getElementById("price").value;
    const artiste_id = document.getElementById("artiste_id").value;

    fetch("TracksController.php", {
        method: "POST",
        body: new URLSearchParams({ action: "addTrack", title, price, artiste_id }),
        headers: { "Content-Type": "application/x-www-form-urlencoded" }
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        if (data.success) {
            loadTracks();
            document.getElementById("addTrackForm").reset();
        }
    })
    .catch(error => console.error("Erreur:", error));
}

function deleteTrack(id) {
    fetch("TracksController.php", {
        method: "POST",
        body: new URLSearchParams({ action: "deleteTrack", id }),
        headers: { "Content-Type": "application/x-www-form-urlencoded" }
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        if (data.success) {
            loadTracks();
        }
    })
    .catch(error => console.error("Erreur:", error));
}
