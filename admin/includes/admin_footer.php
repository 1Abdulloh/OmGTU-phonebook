        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Мобильное меню админ-панели
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('mobile-sidebar-toggle');
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            if (sidebarToggle && sidebar && overlay) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                    overlay.classList.toggle('active');
                });
                
                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                });
                
                // Закрытие меню при клике на ссылку на мобильных
                if (window.innerWidth <= 768) {
                    const sidebarLinks = sidebar.querySelectorAll('.nav-link');
                    sidebarLinks.forEach(link => {
                        link.addEventListener('click', function() {
                            sidebar.classList.remove('active');
                            overlay.classList.remove('active');
                        });
                    });
                }
            }
            
            // Подтверждение удаления
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (!confirm('Вы уверены, что хотите удалить эту запись?')) {
                        e.preventDefault();
                    }
                });
            });
            
            // Автоматическое скрытие алертов
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 3000);
            });
        });
    </script>
</body>
</html>