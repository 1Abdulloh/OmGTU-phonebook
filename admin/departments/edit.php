<?php
require_once '../includes/admin_auth.php';
require_once '../../includes/DepartmentManager.php';

$page_title = "Редактировать подразделение";
include '../includes/admin_header.php';

$departmentManager = new DepartmentManager();

$deptId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$department = $departmentManager->getDepartmentById($deptId);

if (!$department) {
    header('Location: index.php');
    exit;
}

$allDepartments = $departmentManager->getAllDepartments();
// Исключаем текущее подразделение из списка родителей
$availableParents = array_filter($allDepartments, function($dept) use ($deptId) {
    return $dept['id'] != $deptId;
});

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => trim($_POST['name'] ?? ''),
        'description' => trim($_POST['description'] ?? ''),
        'parent_id' => !empty($_POST['parent_id']) ? intval($_POST['parent_id']) : null
    ];
    
    if (empty($data['name'])) {
        $error = 'Название обязательно для заполнения';
    } else {
        try {
            if ($departmentManager->updateDepartment($deptId, $data)) {
                $success = 'Подразделение успешно обновлено!';
                $department = $departmentManager->getDepartmentById($deptId);
            } else {
                $error = 'Ошибка при обновлении подразделения';
            }
        } catch (Exception $e) {
            $error = 'Ошибка при обновлении подразделения: ' . $e->getMessage();
        }
    }
}
?>

<?php include '../includes/admin_sidebar.php'; ?>

<div class="col-md-10 p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Редактировать подразделение</h1>
        <a href="../index.php" class="btn btn-secondary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            На главную
        </a>
    </div>
    <h1 class="h3 mb-4">Редактировать подразделение</h1>
    
    <?php if ($error): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <?php if ($success): ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
    
    <div class="card">
        <div class="card-body">
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="name" class="form-label">Название *</label>
                    <input type="text" class="form-control" id="name" name="name" 
                           value="<?php echo escape($department['name']); ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Описание</label>
                    <textarea class="form-control" id="description" name="description" rows="3"><?php echo escape($department['description']); ?></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="parent_id" class="form-label">Родительское подразделение</label>
                    <select class="form-control" id="parent_id" name="parent_id">
                        <option value="">— Нет —</option>
                        <?php foreach ($availableParents as $dept): ?>
                        <option value="<?php echo $dept['id']; ?>" 
                            <?php echo ($department['parent_id'] == $dept['id']) ? 'selected' : ''; ?>>
                            <?php echo escape($dept['name']); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Сохранить изменения
                    </button>
                    <a href="index.php" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Отмена
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../includes/admin_footer.php'; ?>