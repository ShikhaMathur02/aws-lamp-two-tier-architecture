<?php
// ================= DB CONFIG =================
$servername = "10.0.2.91";   // DB private IP
$username = "student_user";
$password = "shikha@123";
$dbname = "student_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Database connection failed");

// ================= DELETE =================
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM students WHERE id=$id");
    header("Location: index.php");
}

// ================= FETCH FOR EDIT =================
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editData = $conn->query("SELECT * FROM students WHERE id=$id")->fetch_assoc();
}

// ================= UPDATE =================
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $conn->query("UPDATE students SET
        reg_no='{$_POST['reg_no']}',
        name='{$_POST['name']}',
        age='{$_POST['age']}',
        student_id='{$_POST['student_id']}'
        WHERE id=$id");
    header("Location: index.php");
}

// ================= INSERT =================
if (isset($_POST['add'])) {
    $conn->query("INSERT INTO students (reg_no,name,age,student_id)
    VALUES ('{$_POST['reg_no']}','{$_POST['name']}','{$_POST['age']}','{$_POST['student_id']}')");
}

// ================= SEARCH + PAGINATION =================
$search = $_GET['search'] ?? '';
$page = $_GET['page'] ?? 1;
$limit = 5;
$offset = ($page - 1) * $limit;

$where = $search ? "WHERE name LIKE '%$search%' OR reg_no LIKE '%$search%'" : "";

$total = $conn->query("SELECT COUNT(*) as c FROM students $where")->fetch_assoc()['c'];
$result = $conn->query("SELECT * FROM students $where ORDER BY id DESC LIMIT $limit OFFSET $offset");
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Management System</title>

<style>
/* ========== GLOBAL ========== */
body {
    font-family: 'Segoe UI', Arial;
    background: linear-gradient(135deg, #667eea, #764ba2);
    margin: 0;
    padding: 0;
}

.container {
    width: 85%;
    margin: 30px auto;
    background: #ffffff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

/* ========== HEADER ========== */
h1 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

/* ========== FORMS ========== */
form {
    margin-bottom: 20px;
}

input {
    padding: 10px;
    margin: 5px;
    width: 20%;
    border-radius: 6px;
    border: 1px solid #ccc;
}

input:focus {
    outline: none;
    border-color: #667eea;
}

/* ========== BUTTONS ========== */
button {
    padding: 10px 18px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    color: #fff;
    background: linear-gradient(135deg, #43cea2, #185a9d);
    transition: transform 0.2s, box-shadow 0.2s;
}

button:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 12px rgba(0,0,0,0.2);
}

/* ========== TABLE ========== */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 12px;
}

td {
    padding: 10px;
    text-align: center;
    border-bottom: 1px solid #eee;
}

tr:hover {
    background: #f5f7ff;
}

/* ========== ACTION BUTTONS ========== */
a.btn {
    padding: 6px 12px;
    border-radius: 5px;
    color: white;
    text-decoration: none;
    font-size: 14px;
    margin: 2px;
    display: inline-block;
}

.edit {
    background: linear-gradient(135deg, #f7971e, #ffd200);
}

.delete {
    background: linear-gradient(135deg, #ff416c, #ff4b2b);
}

.edit:hover, .delete:hover {
    opacity: 0.85;
}

/* ========== PAGINATION ========== */
.pagination {
    text-align: center;
    margin-top: 20px;
}

.pagination a {
    padding: 8px 14px;
    margin: 3px;
    background: #667eea;
    color: white;
    border-radius: 5px;
    text-decoration: none;
}

.pagination a:hover {
    background: #764ba2;
}

/* ========== FOOTER ========== */
.footer {
    text-align: center;
    margin-top: 25px;
    color: #666;
}
</style>

<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this student?");
}
</script>
</head>

<body>

<div class="container">
<h1>🎓 Student Management System</h1>

<!-- SEARCH -->
<form method="GET">
    <input type="text" name="search" placeholder="Search by name or reg no" value="<?= $search ?>">
    <button>Search</button>
</form>

<!-- ADD / EDIT -->
<form method="POST">
    <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">
    <input name="reg_no" placeholder="Reg No" required value="<?= $editData['reg_no'] ?? '' ?>">
    <input name="name" placeholder="Name" required value="<?= $editData['name'] ?? '' ?>">
    <input name="age" placeholder="Age" value="<?= $editData['age'] ?? '' ?>">
    <input name="student_id" placeholder="Student ID" value="<?= $editData['student_id'] ?? '' ?>">
    <button name="<?= $editData ? 'update' : 'add' ?>">
        <?= $editData ? 'Update Student' : 'Add Student' ?>
    </button>
</form>

<!-- TABLE -->
<table>
<tr>
<th>ID</th>
<th>Reg No</th>
<th>Name</th>
<th>Age</th>
<th>Student ID</th>
<th>Actions</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
<td><?= $row['id'] ?></td>
<td><?= $row['reg_no'] ?></td>
<td><?= $row['name'] ?></td>
<td><?= $row['age'] ?></td>
<td><?= $row['student_id'] ?></td>
<td>
    <a class="btn edit" href="?edit=<?= $row['id'] ?>">Edit</a>
    <a class="btn delete" href="?delete=<?= $row['id'] ?>" onclick="return confirmDelete()">Delete</a>
</td>
</tr>
<?php } ?>
</table>

<!-- PAGINATION -->
<div class="pagination">
<?php for($i=1;$i<=ceil($total/$limit);$i++){ ?>
<a href="?page=<?= $i ?>&search=<?= $search ?>"><?= $i ?></a>
<?php } ?>
</div>

<div class="footer">
🚀 Built on AWS LAMP Stack | PHP • MySQL • EC2
</div>

</div>
</body>
</html>
