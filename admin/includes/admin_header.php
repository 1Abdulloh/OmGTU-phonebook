<?php
if (!isset($page_title)) {
    $page_title = 'Админ-панель';
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - ОмГТУ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .sidebar {
            min-height: 100vh;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .sidebar .nav-link {
            color: #333;
            padding: 10px 15px;
            margin: 5px 0;
            border-radius: 5px;
            display: flex;
            align-items: center;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: white;
        }
        .sidebar .nav-link svg {
            width: 20px;
            height: 20px;
            margin-right: 10px;
            flex-shrink: 0;
        }
        
        .content {
            padding: 20px;
            padding-bottom: 60px;
        }
        
        .container-fluid {
            flex: 1;
            padding-bottom: 40px;
        }
        
        .card {
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
            border: none;
        }
        
        .table th {
            border-top: none;
            background-color: #f8f9fa;
        }
        
        .mobile-sidebar-toggle {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 5px 10px;
        }
        
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1040;
        }
        
        .sidebar-overlay.active {
            display: block;
        }
        
        @media (max-width: 768px) {
            .mobile-sidebar-toggle {
                display: block;
            }
            
            .sidebar {
                position: fixed;
                top: 56px;
                left: 0;
                width: 280px;
                height: calc(100vh - 56px);
                z-index: 1050;
                transform: translateX(-100%);
                overflow-y: auto;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .col-md-2 {
                position: static;
            }
            
            .col-md-10 {
                width: 100%;
                padding: 15px !important;
            }
            
            .navbar-text {
                display: none;
            }
            
            .table-responsive {
                font-size: 12px;
            }
            
            .table th,
            .table td {
                padding: 8px 4px;
                font-size: 11px;
            }
            
            .btn-group-sm .btn {
                padding: 2px 6px;
                font-size: 10px;
            }
            
            .card-body {
                padding: 15px;
            }
            
            .row.mb-4 > div {
                margin-bottom: 15px;
            }
            
            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 10px;
            }
            
            .d-flex.justify-content-between .btn {
                width: 100%;
            }
        }
        
        @media (max-width: 480px) {
            .table th,
            .table td {
                padding: 6px 2px;
                font-size: 10px;
            }
            
            .card-header h5 {
                font-size: 14px;
            }
            
            .h3 {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="mobile-sidebar-toggle" id="mobile-sidebar-toggle" aria-label="Меню">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
            <a class="navbar-brand" href="<?php 
                $currentScript = $_SERVER['PHP_SELF'];
                $isInSubfolder = (strpos($currentScript, '/admin/contacts/') !== false || 
                                  strpos($currentScript, '/admin/departments/') !== false || 
                                  strpos($currentScript, '/admin/users/') !== false);
                echo $isInSubfolder ? '../index.php' : 'index.php'; 
            ?>">
                <i class="bi bi-building"></i>
                <span class="d-none d-sm-inline">Админ-панель ОмГТУ</span>
                <span class="d-inline d-sm-none">Админ</span>
            </a>
            <div class="navbar-text text-light d-none d-md-block">
                Вы вошли как: <strong><?php echo $_SESSION['user_name']; ?></strong> 
                (<?php echo $_SESSION['user_role']; ?>)
            </div>
        </div>
    </nav>
    
    <div class="sidebar-overlay" id="sidebar-overlay"></div>
    
    <div class="container-fluid">
        <div class="row">