   // Fungsi untuk toggle aksi tambahan (misalnya status)
   function toggleSlide(todoId) {
    const actions = document.getElementById('todo-actions-' + todoId);
    console.log(actions); // Debugging: cek apakah kotak ditemukan
    if (actions) {
        actions.style.display = (actions.style.display === 'block' ? 'none' : 'block');
    }
}

// Fungsi untuk menampilkan modal ketika tombol Edit ditekan
function showUpdateForm(id) {
    console.log("Modal ID: " + id); // Debugging: cek apakah id benar
    toggleModal(id, 'show'); // Tampilkan modal dan overlay
}

// Fungsi untuk menutup modal ketika tombol Cancel ditekan
function cancelUpdateForm(id) {
    toggleModal(id, 'hide'); // Sembunyikan modal dan overlay
}

// Fungsi untuk menangani interaksi tombol tambah todo
document.getElementById('addTodoBtn').addEventListener('click', function() {
    document.getElementById('addTodoForm').style.display = 'block';
});

// Fungsi untuk menangani interaksi tombol batal di form tambah todo
document.getElementById('cancelBtn').addEventListener('click', function() {
    document.getElementById('addTodoForm').style.display = 'none';
});

// Fungsi untuk menampilkan konfirmasi penghapusan
function confirmDelete() {
    // Menggunakan confirm() untuk menampilkan kotak konfirmasi
    var confirmation = confirm("Apakah Anda yakin ingin menghapus tugas ini?");
    
    // Jika pengguna memilih 'OK' (true), maka formulir akan disubmit
    if (confirmation) {
        return true;
    }
    
    // Jika pengguna memilih 'Cancel' (false), formulir tidak akan disubmit
    return false;
}

// Fungsi untuk menampilkan modal edit
// Fungsi untuk menampilkan modal edit
function showUpdateForm(id) {
    // Dapatkan elemen modal dan overlay berdasarkan ID
    const modal = document.getElementById('edit-modal-' + id);
    const overlay = document.getElementById('overlay-' + id);

    // Pastikan elemen modal dan overlay ditemukan
    if (modal && overlay) {
        modal.style.display = 'block'; // Tampilkan modal
        overlay.style.display = 'block'; // Tampilkan overlay
        console.log(`Modal dengan ID edit-modal-${id} berhasil ditampilkan.`);
    } else {
        console.error(`Modal atau overlay dengan ID ${id} tidak ditemukan.`);
    }
}

// Fungsi untuk menyembunyikan modal
function cancelUpdateForm(id) {
    const modal = document.getElementById('edit-modal-' + id);
    const overlay = document.getElementById('overlay-' + id);

    if (modal && overlay) {
        modal.style.display = 'none'; // Sembunyikan modal
        overlay.style.display = 'none'; // Sembunyikan overlay
    } else {
        console.error(`Modal atau overlay dengan ID ${id} tidak ditemukan.`);
    }
}

// Fungsi untuk menangani klik pada tombol Edit (pada tiap Todo)
document.querySelectorAll('.edit-btn').forEach(function(button) {
    button.addEventListener('click', function() {
        const todoId = button.getAttribute('data-id'); // Ambil ID todo dari data-id
        showUpdateForm(todoId); // Menampilkan modal dengan ID yang sesuai
    });
});

// Fungsi untuk menangani klik pada overlay untuk menutup modal
document.querySelectorAll('.overlay').forEach(function(overlay) {
    overlay.addEventListener('click', function() {
        const todoId = overlay.getAttribute('data-id');
        cancelUpdateForm(todoId); // Menyembunyikan modal dan overlay
    });
});


// Fungsi untuk menangani klik pada tombol Edit (pada tiap Todo)
document.querySelectorAll('.edit-btn').forEach(function(button) {
    button.addEventListener('click', function() {
        const todoId = button.getAttribute('data-id'); // Ambil ID todo dari data-id
        showUpdateForm(todoId); // Menampilkan modal dengan ID yang sesuai
    });
});

// Fungsi untuk menangani klik pada tombol Cancel pada setiap modal
document.querySelectorAll('.cancel-btn').forEach(function(button) {
    button.addEventListener('click', function() {
        const todoId = button.getAttribute('data-id'); // Ambil ID todo dari data-id
        cancelUpdateForm(todoId); // Menyembunyikan modal dengan ID yang sesuai
    });
});

// Fungsi untuk menangani klik pada overlay untuk menutup modal
document.querySelectorAll('.overlay').forEach(function(overlay) {
    overlay.addEventListener('click', function() {
        const todoId = overlay.getAttribute('data-id');
        cancelUpdateForm(todoId); // Menyembunyikan modal dan overlay
    });
});

// Fungsi untuk menangani perubahan status tugas
function toggleModal(id, action) {
    const modal = document.getElementById('edit-modal-' + id);
    const overlay = document.getElementById('overlay-' + id);
    
    if (action === 'show') {
        modal.style.display = 'block';
        overlay.style.display = 'block';
    } else {
        modal.style.display = 'none';
        overlay.style.display = 'none';
    }
}

document.addEventListener("DOMContentLoaded", function () {
    var dueDateInput = document.querySelector("input[name='due_date']");
    var submitButton = document.querySelector("button[type='submit']");
    
    dueDateInput.addEventListener("change", function () {
        var dueDate = dueDateInput.value;
        var today = new Date().toISOString().split("T")[0];

        if (dueDate < today) {
            alert("Tanggal tugas tidak boleh sebelum hari ini!");
            submitButton.disabled = true; // Disable tombol submit
        } else {
            submitButton.disabled = false; // Enable kalau tanggal valid
        }
    });
});






document.addEventListener("DOMContentLoaded", function () {
    var dueDateInput = document.querySelector(".modal-content input[name='due_date']");
    var updateButton = document.querySelector(".modal-content button[type='submit']");
    
    dueDateInput.addEventListener("change", function () {
        var dueDate = dueDateInput.value;
        var today = new Date().toISOString().split("T")[0];

        if (dueDate < today) {
            alert("Anda tidak bisa mengedit tanggal sebelum hari ini!");
            updateButton.disabled = true; // Disable tombol update
        } else {
            updateButton.disabled = false; // Enable kalau tanggal valid
        }
    });
});








document.addEventListener("DOMContentLoaded", function () {
    var dueDateInput = document.querySelector("input[name='due_date']");
    var submitButton = document.querySelector("button[type='submit']");
    
    dueDateInput.addEventListener("change", function () {
        var dueDate = dueDateInput.value;
        var today = new Date().toISOString().split("T")[0];

        if (dueDate < today) {
            alert("Tanggal tugas tidak boleh sebelum hari ini!");
            submitButton.disabled = true; // Disable tombol submit
        } else {
            submitButton.disabled = false; // Enable kalau tanggal valid
        }
    });
});


document.addEventListener("DOMContentLoaded", function () {
    var dueDateInput = document.querySelector(".modal-content input[name='due_date']");
    var updateButton = document.querySelector(".modal-content button[type='submit']");
    
    dueDateInput.addEventListener("change", function () {
        var dueDate = dueDateInput.value;
        var today = new Date().toISOString().split("T")[0];

        if (dueDate < today) {
            alert("Anda tidak bisa mengedit tanggal sebelum hari ini!");
            updateButton.disabled = true; // Disable tombol update
        } else {
            updateButton.disabled = false; // Enable kalau tanggal valid
        }
    });
});
