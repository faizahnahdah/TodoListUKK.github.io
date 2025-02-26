<?php
include('db.php');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    // Setel atribut error mode untuk PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

// Tambah todo
if (isset($_POST['task']) && isset($_POST['due_date']) && !isset($_POST['update_id'])) {
    $task = htmlspecialchars($_POST['task']); // Sanitasi input
    $due_date = $_POST['due_date'];
    $status = $_POST['status']; // Ambil status dari form
    $sql = "INSERT INTO todos (task, due_date, status) VALUES (:task, :due_date, :status)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':task', $task);
    $stmt->bindParam(':due_date', $due_date);
    $stmt->bindParam(':status', $status);
    $stmt->execute();
}

// Update status todo
if (isset($_POST['update_status_id']) && isset($_POST['status'])) {
    $id = $_POST['update_status_id'];
    $status = $_POST['status'];
    $sql = "UPDATE todos SET status = :status WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':status', $status);
    $stmt->execute();
}

// Update todo
if (isset($_POST['update_id']) && isset($_POST['task']) && isset($_POST['due_date'])) {
    $id = $_POST['update_id'];
    $task = htmlspecialchars($_POST['task']); // Sanitasi input
    $due_date = $_POST['due_date'];
    $status = $_POST['status']; // Ambil status dari form
    $sql = "UPDATE todos SET task = :task, due_date = :due_date, status = :status WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':task', $task);
    $stmt->bindParam(':due_date', $due_date);
    $stmt->bindParam(':status', $status);
    $stmt->execute();
}

// Hapus todo
if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $sql = "DELETE FROM todos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

// Ambil semua todo
$stmt = $pdo->prepare("SELECT * FROM todos ORDER BY created_at DESC");
$stmt->execute();
$todos = $stmt->fetchAll();  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" href="css/hasill.css">
    <link rel="stylesheet" href="css/aksii.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <h1 id="awal">List Kegiatan Dan Tugas</h1>

    <button id="addTodoBtn">+</button>
    
    <div id="addTodoForm" style="display:none;">
    <div id="TodoForm">
        <form action="index.php" method="post">
            <h2>Tambah Tugas</h2>
            <input type="text" name="task" placeholder="Tambah tugas" required>
            <input type="date" name="due_date" required>

            <!-- Menambahkan form untuk status -->
            <select class="pilihanstatus" name="status" required>
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
            </select>

            <div class="buttons">
                <button type="button" id="cancelBtn">Batal</button>
                <button type="submit">Tambah</button>
            </div>
        </form>
    </div>
</div>

<!-- Tampilkan Tugas -->
<table class="show-todo-section">
<thead class="desatas">
    <tr>
  
    <td class="Tugas">Tugas</td>
            <td class="Dibuat">Dibuat</td>
            <td class="JW">Jangka Waktu</td>
            <td class="status">Prioritas</td>
            <td class="aksi">Aksi</td>
    </tr>
</thead>
<tbody>
    <?php foreach ($todos as $todo): ?>
        <tr>
            <td>
                <div class="todo-item">
                <div class="list">
    <div style="text-align: center;">
        <input type="checkbox" name="todo_check[]" value="<?php echo $todo['id']; ?>" />
    </div>
    <div class="taskk"><?php echo htmlspecialchars($todo['task']); ?></div>
</div>

<div class="todo-info">
    <div class="created-at"><?php echo date('d - m - Y', strtotime($todo['created_at'])); ?></div>
    <div class="shift-right"><?php echo date('d - m - Y', strtotime($todo['due_date'])); ?></div>
    <div class="st"><strong><?php echo htmlspecialchars($todo['status']); ?></strong></div>         
    <button class="menu-toggle" onclick="toggleSlide(<?php echo $todo['id']; ?>)">⋮</button>
</div>
                    <div id="todo-actions-<?php echo $todo['id']; ?>" class="kotakbelakang" style="display: none;">
                        <div class="todo-actions">
                           
                        <button class="edit-btn" data-id="<?php echo $todo['id']; ?>" onclick="showUpdateForm(<?php echo $todo['id']; ?>)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                        <!-- Hapus Tugas -->
                            <form action="index.php" method="post" style="display:inline;" onsubmit="return confirmDelete();">
                                <input type="hidden" name="delete_id" value="<?php echo $todo['id']; ?>">
                                <button type="submit" class="delete" style="background: none; border: none; cursor: pointer;">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </td>
        </tr>

        
                <!-- Modal Edit -->
                <div id="edit-modal-<?php echo $todo['id']; ?>" class="edit-modal" style="display: none;">
                    <div class="modal-content">
                        <form action="index.php" method="post">
                            <input type="hidden" name="update_id" value="<?php echo $todo['id']; ?>">
                            <h2>Edit Tugas</h2>
                            <input type="text" name="task" value="<?php echo htmlspecialchars($todo['task']); ?>" required>
                            <input type="date" name="due_date" value="<?php echo $todo['due_date']; ?>" required>
                            <select class="pilihanstatus" name="status" required>
                                <option value="High" <?php echo ($todo['status'] == 'High') ? 'selected' : ''; ?>>High</option>
                                <option value="Medium" <?php echo ($todo['status'] == 'Medium') ? 'selected' : ''; ?>>Medium</option>
                                <option value="Low" <?php echo ($todo['status'] == 'Low') ? 'selected' : ''; ?>>Low</option>
                            </select>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <button type="button" onclick="cancelUpdateForm(<?php echo $todo['id']; ?>)">Cancel</button>
                                <button type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Overlay untuk modal -->
                <div id="overlay-<?php echo $todo['id']; ?>" class="overlay" style="display: none;"></div>

    <?php endforeach; ?>
</tbody>
</table>


<script src="js/script.js"></script>



</body>
</html>
