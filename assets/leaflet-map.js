document.addEventListener("DOMContentLoaded", function () {
    let map = L.map("lpm-map").setView([20, 0], 2); // Default world view

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: '&copy; OpenStreetMap contributors',
    }).addTo(map);

    fetch(lpmData.apiUrl)
        .then(response => response.json())
        .then(posts => {
            posts.forEach(post => {
                let city = post.city;
                if (!city) return;

                let geocodeUrl = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(city)}`;

                fetch(geocodeUrl)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            let lat = data[0].lat;
                            let lon = data[0].lon;
                            let marker = L.marker([lat, lon]).addTo(map);
                            marker.bindPopup(`<a href="${post.link}">${post.title}</a>`);
                        }
                    })
                    .catch(error => console.error("Geocoding error:", error));
            });
        })
        .catch(error => console.error("Error fetching locations:", error));
});
