<?php
require_once 'includes/admin_auth.php';
require_once '../includes/ContactManager.php';
require_once '../includes/DepartmentManager.php';

$page_title = "Админ-панель";
include 'includes/admin_header.php';

$contactManager = new ContactManager();
$departmentManager = new DepartmentManager();

$totalContacts = $contactManager->getTotalContacts();
$totalDepartments = count($departmentManager->getAllDepartments());
$recentContacts = $contactManager->getAllContacts(5);
?>

<div class="container-fluid">
    <div class="row">
        <?php include 'includes/admin_sidebar.php'; ?>
        
        <div class="col-md-10 p-4">
            <h1 class="mb-4">Добро пожаловать, <?php echo $_SESSION['user_name']; ?>!</h1>
            
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Контактов</h5>
                            <h2 class="card-text"><?php echo $totalContacts; ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Подразделений</h5>
                            <h2 class="card-text"><?php echo $totalDepartments; ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title">Роль</h5>
                            <h2 class="card-text"><?php echo $_SESSION['user_role']; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h5>Последние контакты</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Имя</th>
                                    <th>Должность</th>
                                    <th>Телефон</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recentContacts as $contact): ?>
                                <tr>
                                    <td><?php echo $contact['id']; ?></td>
                                    <td><?php echo escape($contact['name']); ?></td>
                                    <td><?php echo escape($contact['position']); ?></td>
                                    <td><?php echo escape($contact['phone']); ?></td>
                                    <td>
                                        <a href="contacts/edit.php?id=<?php echo $contact['id']; ?>" class="btn btn-sm btn-primary">Редактировать</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <a href="contacts/" class="btn btn-primary">Все контакты</a>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Быстрые действия</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="contacts/create.php" class="btn btn-success w-100 mb-2">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                Добавить контакт
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="departments/create.php" class="btn btn-success w-100 mb-2">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                Добавить подразделение
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/admin_footer.php'; ?>