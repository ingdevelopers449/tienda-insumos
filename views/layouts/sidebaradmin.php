<?php
$id_rol = $usuario['id_rol'];
$rol_nombre = '';
switch ($id_rol) {
    case '1':
        $rol_nombre = 'Administrador';
        break;
    case '2':
        $rol_nombre = 'Vendedor';
        break;
    case '3':
        $rol_nombre = 'Cliente';
        break;
}
$nombreCompleto = $usuario['usuario'];
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<style>
    .sidebar-link {
        color: #64748b;
        font-family: var(--font-heading);
        font-weight: 500;
        padding: 10px 16px 10px 24px;
        border-radius: 0 8px 8px 0;
        transition: var(--transition-smooth);
        border-left: 4px solid transparent;
        font-size: 0.925rem;
    }
    .sidebar-link:hover {
        background-color: rgba(16, 185, 129, 0.03);
        color: var(--primary-hover);
        border-left-color: rgba(16, 185, 129, 0.3);
    }
    .sidebar-link.active {
        background: linear-gradient(90deg, rgba(16, 185, 129, 0.08) 0%, rgba(255, 255, 255, 0) 100%);
        color: var(--primary);
        font-weight: 600;
        border-left-color: var(--primary);
    }
    .sidebar-link i {
        font-size: 1.15rem;
    }
    .menu-header {
        font-size: 0.65rem;
        letter-spacing: 0.15em;
        font-family: var(--font-heading);
        color: #94a3b8;
        padding-left: 24px;
        margin-top: 20px;
        margin-bottom: 8px;
    }
</style>

<aside class="flex-shrink-0 bg-white border-end d-flex flex-column position-sticky top-0 vh-100" style="width: 260px; min-width: 260px; box-shadow: 10px 0 30px rgba(0,0,0,0.015);">
    <!-- Brand Logo Section -->
    <div class="d-flex align-items-center gap-3 px-4 border-bottom" style="height: 90px;">
        <div class="bg-success bg-opacity-10 text-success rounded-3 d-flex align-items-center justify-content-center border border-success border-opacity-10" style="width: 42px; height: 42px; min-width: 42px;">
            <i class="bi bi-patch-check-fill fs-4"></i>
        </div>
        <div>
            <div class="fw-extrabold text-dark m-0 fs-5" style="font-family: var(--font-heading); letter-spacing: -0.5px; font-weight: 800; line-height: 1.2;">
                <span class="text-success">Agri</span>Stock
            </div>
            <div class="text-uppercase fw-bold text-muted" style="font-size: 0.6rem; letter-spacing: 0.25em;">Panel Control</div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="pe-3 ps-0 d-flex flex-column gap-1 flex-grow-1 overflow-y-auto py-3">
        <?php if ($id_rol === '1' || $id_rol === 1): ?>
            <div class="text-uppercase fw-bold menu-header">Inicio</div>
            <a href="dashboard.php" class="sidebar-link d-flex align-items-center gap-3 text-decoration-none mb-1 <?= $currentPage == 'dashboard.php' ? 'active' : '' ?>">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>

            <div class="text-uppercase fw-bold menu-header">Gestión</div>
            <a href="../admin/gusuarios.php" class="sidebar-link d-flex align-items-center gap-3 text-decoration-none mb-1 <?= $currentPage == 'gusuarios.php' ? 'active' : '' ?>">
                <i class="bi bi-people"></i>
                <span>Gestión Usuarios</span>
            </a>
            <a href="proveedores.php" class="sidebar-link d-flex align-items-center gap-3 text-decoration-none mb-1 <?= $currentPage == 'proveedores.php' ? 'active' : '' ?>">
                <i class="bi bi-truck"></i>
                <span>Proveedores</span>
            </a>
            <a href="categorias.php" class="sidebar-link d-flex align-items-center gap-3 text-decoration-none mb-1 <?= $currentPage == 'categorias.php' ? 'active' : '' ?>">
                <i class="bi bi-tags"></i>
                <span>Categorías</span>
            </a>
            <a href="productos.php" class="sidebar-link d-flex align-items-center gap-3 text-decoration-none mb-1 <?= $currentPage == 'productos.php' ? 'active' : '' ?>">
                <i class="bi bi-box-seam"></i>
                <span>Productos</span>
            </a>
        <?php endif; ?>

        <?php if ($id_rol === '2' || $id_rol === 2): ?>
            <div class="text-uppercase fw-bold menu-header">Inicio</div>
            <a href="../vendedor/dashboard.php" class="sidebar-link d-flex align-items-center gap-3 text-decoration-none mb-1 <?= $currentPage == 'dashboard.php' ? 'active' : '' ?>">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>

            <div class="text-uppercase fw-bold menu-header">Operaciones</div>
            <a href="../vendedor/ventas.php" class="sidebar-link d-flex align-items-center gap-3 text-decoration-none mb-1 <?= $currentPage == 'ventas.php' ? 'active' : '' ?>">
                <i class="bi bi-cart"></i>
                <span>Ventas</span>
            </a>
            <a href="../vendedor/productos.php" class="sidebar-link d-flex align-items-center gap-3 text-decoration-none mb-1 <?= $currentPage == 'productos.php' ? 'active' : '' ?>">
                <i class="bi bi-box-seam"></i>
                <span>Productos</span>
            </a>
        <?php endif; ?>

        <?php if ($id_rol === '3' || $id_rol === 3): ?>
            <div class="text-uppercase fw-bold menu-header">Portal</div>
            <a href="../cliente/dashboard.php" class="sidebar-link d-flex align-items-center gap-3 text-decoration-none mb-1 <?= $currentPage == 'dashboard.php' ? 'active' : '' ?>">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
            <a href="../cliente/compras.php" class="sidebar-link d-flex align-items-center gap-3 text-decoration-none mb-1 <?= $currentPage == 'compras.php' ? 'active' : '' ?>">
                <i class="bi bi-bag"></i>
                <span>Mis Compras</span>
            </a>
        <?php endif; ?>
    </nav>

    <!-- User Profile Footer Card -->
    <div class="p-3 border-top bg-light bg-opacity-50">
        <div class="d-flex align-items-center gap-2 p-2 rounded-3 bg-white border shadow-sm">
            <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold fs-6" style="width: 36px; height: 36px; min-width: 36px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%) !important;">
                <?= strtoupper(substr($nombreCompleto, 0, 1)) ?>
            </div>
            <div class="overflow-hidden flex-grow-1">
                <h6 class="text-dark mb-0 fw-bold text-truncate small" style="font-family: var(--font-heading);"><?= htmlspecialchars($nombreCompleto) ?></h6>
                <span class="text-muted d-block text-truncate" style="font-size: 0.725rem;"><?= htmlspecialchars($rol_nombre) ?></span>
            </div>
            <a href="../../controllers/auth/authController.php?accion=logout" class="btn btn-sm btn-outline-danger border-0 p-1 rounded-circle d-flex align-items-center justify-content-center" title="Cerrar Sesión" style="width: 28px; height: 28px;">
                <i class="bi bi-power fs-6"></i>
            </a>
        </div>
    </div>
</aside>

<main class="flex-grow-1 d-flex flex-column bg-light min-vh-100" style="min-width: 0;">
    <header class="d-flex align-items-center justify-content-between px-4 px-lg-5 text-white shadow-sm position-sticky top-0" style="height: 90px; background: linear-gradient(135deg, #0b0f19 0%, #1e293b 100%); border-bottom: 1px solid rgba(255, 255, 255, 0.08); z-index: 1020;">
        <h1 class="h3 mb-0 fw-light" style="font-family: var(--font-heading);"><?= htmlspecialchars($titulo) ?></h1>

        <div class="d-flex align-items-center gap-3 pe-2 pe-md-4">
            <div class="text-end">
                <div class="fw-bold text-white mb-0" style="font-size: 0.95rem; line-height: 1.2; font-family: var(--font-heading);"><?= htmlspecialchars(ucfirst($rol_nombre)) ?></div>
                <div class="text-secondary" style="font-size: 0.85rem; opacity: 0.8;"><?= htmlspecialchars($nombreCompleto) ?></div>
            </div>
            <div class="rounded-circle d-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success border border-success border-opacity-20" style="width: 46px; height: 46px;">
                <i class="fa-solid fa-circle-user fs-3"></i>
            </div>
        </div>
    </header>

    <div class="p-4 p-lg-5 flex-grow-1">