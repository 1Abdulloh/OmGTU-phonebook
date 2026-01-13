<?php
require_once '../includes/admin_auth.php';
require_once '../../includes/DepartmentManager.php';

$page_title = "Управление подразделениями";
include '../includes/admin_header.php';

$departmentManager = new DepartmentManager();
$departments = $departmentManager->getAllDepartments();

// Удаление подразделения
if (isset($_GET['delete']) && $_SESSION['user_role'] === 'admin') {
    if ($departmentManager->deleteDepartment($_GET['delete'])) {
        $_SESSION['flash']['success'] = 'Подразделение успешно удалено';
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['flash']['error'] = 'Ошибка при удалении подразделения';
    }
}

$flashMessage = get_flash_message('success') ?? get_flash_message('error');
?>

<?php include '../includes/admin_sidebar.php'; ?>

<div class="col-md-10 p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Управление подразделениями</h1>
        <a href="../index.php" class="btn btn-secondary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            На главную
        </a>
    </div>
    
    <?php if ($flashMessage): ?>
    <div class="alert alert-<?php echo strpos($flashMessage, 'Ошибка') !== false ? 'danger' : 'success'; ?> alert-dismissible fade show" role="alert">
        <?php echo $flashMessage; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>
    
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Список подразделений</h5>
            <a href="create.php" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Добавить подразделение
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Описание</th>
                            <th>Контактов</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($departments) > 0): ?>
                            <?php foreach ($departments as $dept): ?>
                            <tr>
                                <td><?php echo $dept['id']; ?></td>
                                <td><?php echo escape($dept['name'] ?? ''); ?></td>
                                <td><?php echo escape($dept['description'] ?? ''); ?></td>
                                <td><?php echo $dept['contact_count'] ?? 0; ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="edit.php?id=<?php echo $dept['id']; ?>" class="btn btn-primary" title="Редактировать">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                        </a>
                                        <?php if ($_SESSION['user_role'] === 'admin'): ?>
                                        <a href="?delete=<?php echo $dept['id']; ?>" 
                                           class="btn btn-danger delete-btn" 
                                           onclick="return confirm('Удалить подразделение? Все контакты будут отвязаны.')"
                                           title="Удалить">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            </svg>
                                        </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mb-2" style="opacity: 0.3;">
                                        <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                                        <path d="M2 17l10 5 10-5"></path>
                                        <path d="M2 12l10 5 10-5"></path>
                                    </svg>
                                    <p class="mb-0">Подразделений пока нет</p>
                                    <a href="create.php" class="btn btn-primary btn-sm mt-2">Добавить первое подразделение</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/admin_footer.php'; ?>