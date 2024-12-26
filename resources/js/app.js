import './bootstrap';
import 'bootstrap';

import swal from 'sweetalert2';
window.Swal = swal;

document.addEventListener("DOMContentLoaded", function () {
    document.addEventListener("submit", function (e) {
        if (e.target && e.target.id === "contactForm") {
            e.preventDefault();

            let form = document.getElementById("contactForm");
            let formData = new FormData(form);

            let icon = 'error', title = 'HATA';
            let csrfToken = document.querySelector('meta[name="_token"]').getAttribute('content');

            fetch(window.location, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            })
                .then(async (response) => {
                    let res = await response.json();

                    if (response.ok && res.status) {
                        icon = 'success';
                        title = 'BAŞARILI';
                        form.reset();
                    }

                    Swal.fire({
                        icon: icon,
                        title: title,
                        text: res.message,
                        confirmButtonText: 'Kapat',
                        confirmButtonColor: "rgba(70, 219, 249, 0.9)",
                    });
                })
                .catch((error) => {
                    Swal.fire({
                        icon: icon,
                        title: title,
                        text: "Bir hata oluştu.",
                        confirmButtonText: 'Kapat',
                        confirmButtonColor: "rgba(70, 219, 249, 0.9)",
                    });
                });
        }
    });
});

