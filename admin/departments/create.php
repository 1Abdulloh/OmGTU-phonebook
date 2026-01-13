<?php
require_once '../includes/admin_auth.php';
require_once '../../includes/DepartmentManager.php';

$page_title = "Добавить подразделение";
include '../includes/admin_header.php';

$departmentManager = new DepartmentManager();

// Получаем список всех подразделений для выбора родительского
$allDepartments = $departmentManager->getAllDepartments();

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
            $deptId = $departmentManager->createDepartment($data);
            $success = 'Подразделение успешно создано! ID: ' . $deptId;
            $_POST = [];
        } catch (Exception $e) {
            $error = 'Ошибка при создании подразделения: ' . $e->getMessage();
        }
    }
}
?>

<?php include '../includes/admin_sidebar.php'; ?>

<div class="col-md-10 p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Добавить подразделение</h1>
        <a href="../index.php" class="btn btn-secondary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            На главную
        </a>
    </div>
    
    <?php if ($error): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $error; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>
    
    <?php if ($success): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $success; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>
    
    <div class="card">
        <div class="card-body">
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="name" class="form-label">Название *</label>
                    <input type="text" class="form-control" id="name" name="name" 
                           value="<?php echo escape($_POST['name'] ?? ''); ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Описание</label>
                    <textarea class="form-control" id="description" name="description" rows="3"><?php echo escape($_POST['description'] ?? ''); ?></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="parent_id" class="form-label">Родительское подразделение</label>
                    <select class="form-control" id="parent_id" name="parent_id">
                        <option value="">— Нет —</option>
                        <?php foreach ($allDepartments as $dept): ?>
                        <option value="<?php echo $dept['id']; ?>" 
                            <?php echo (($_POST['parent_id'] ?? '') == $dept['id']) ? 'selected' : ''; ?>>
                            <?php echo escape($dept['name']); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Сохранить
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