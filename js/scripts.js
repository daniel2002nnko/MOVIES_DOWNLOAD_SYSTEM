// scripts.js

document.addEventListener("DOMContentLoaded", function() {
    const downloadButtons = document.querySelectorAll(".download-btn");

    downloadButtons.forEach(button => {
        button.addEventListener("click", function() {
            const movieId = this.dataset.movieId;
            const userId = this.dataset.userId;
            downloadMovie(movieId, userId);
        });
    });
});

function downloadMovie(movieId, userId) {
    fetch('php/download.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ movie_id: movieId, user_id: userId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Download started!');
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function showRegister() {
    document.getElementById('login-section').style.display = 'none';
    document.getElementById('register-section').style.display = 'block';
}

function showLogin() {
    document.getElementById('login-section').style.display = 'block';
    document.getElementById('register-section').style.display = 'none';
}
