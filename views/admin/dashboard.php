<?php
session_start();

if (!isset($_SESSION['usuario']) || ($_SESSION['usuario']['id_rol'] != 1 && $_SESSION['usuario']['id_rol'] !== '1')) {
    header('Location: ../../views/auth/login.php');
    exit;
}

require_once __DIR__ . '/../../config/database.php';

$result = $conn->query('SELECT id_rol, COUNT(*) as total FROM usuarios GROUP BY id_rol');
$totalVendedores = 0;
$totalClientes = 0;
$totalAdmins = 0;
while ($row = $result->fetch_assoc()) {
    if ($row['id_rol'] == 1)
        $totalAdmins = $row['total'];
    if ($row['id_rol'] == 2)
        $totalVendedores = $row['total'];
    if ($row['id_rol'] == 3)
        $totalClientes = $row['total'];
}
$totalUsuarios = $totalAdmins + $totalVendedores + $totalClientes;

// Dummy values for other stats until models are created
$totalProductos = 0;
$totalPedidos = 0;

$titulo = 'Dashboard Administrador';
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/sidebaradmin.php';
?>

<div class="d-flex flex-column gap-4">
    <!-- Metric Cards -->
    <div class="row g-4">
        <!-- Card Clientes -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card premium-card bg-white rounded-4 border-0 p-4 shadow-sm d-flex flex-row align-items-center gap-3">
                <div class="card-icon-wrapper rounded-circle d-flex align-items-center justify-content-center text-success bg-success bg-opacity-10" style="width: 56px; height: 56px;">
                    <i class="bi bi-people fs-4"></i>
                </div>
                <div>
                    <span class="text-muted small fw-medium d-block">Clientes</span>
                    <span class="fs-3 fw-bold text-dark"><?= $totalClientes ?></span>
                </div>
            </div>
        </div>

        <!-- Card Vendedores -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card premium-card bg-white rounded-4 border-0 p-4 shadow-sm d-flex flex-row align-items-center gap-3">
                <div class="card-icon-wrapper rounded-circle d-flex align-items-center justify-content-center text-warning bg-warning bg-opacity-10" style="width: 56px; height: 56px;">
                    <i class="bi bi-person-badge fs-4"></i>
                </div>
                <div>
                    <span class="text-muted small fw-medium d-block">Vendedores</span>
                    <span class="fs-3 fw-bold text-dark"><?= $totalVendedores ?></span>
                </div>
            </div>
        </div>

        <!-- Card Productos -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card premium-card bg-white rounded-4 border-0 p-4 shadow-sm d-flex flex-row align-items-center gap-3">
                <div class="card-icon-wrapper rounded-circle d-flex align-items-center justify-content-center text-primary bg-primary bg-opacity-10" style="width: 56px; height: 56px;">
                    <i class="bi bi-box-seam fs-4"></i>
                </div>
                <div>
                    <span class="text-muted small fw-medium d-block">Productos</span>
                    <span class="fs-3 fw-bold text-dark"><?= $totalProductos ?></span>
                </div>
            </div>
        </div>

        <!-- Card Pedidos -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card premium-card bg-white rounded-4 border-0 p-4 shadow-sm d-flex flex-row align-items-center gap-3">
                <div class="card-icon-wrapper rounded-circle d-flex align-items-center justify-content-center text-danger bg-danger bg-opacity-10" style="width: 56px; height: 56px;">
                    <i class="bi bi-cart3 fs-4"></i>
                </div>
                <div>
                    <span class="text-muted small fw-medium d-block">Pedidos</span>
                    <span class="fs-3 fw-bold text-dark"><?= $totalPedidos ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Secondary panels -->
    <div class="row g-4">
        <!-- Accesos Rápidos -->
        <div class="col-12 col-lg-6">
            <div class="card border-0 rounded-4 shadow-sm p-4 bg-white">
                <h3 class="h5 fw-bold text-dark mb-4" style="font-family: var(--font-heading);">Accesos Rápidos</h3>
                <div class="row g-3">
                    <div class="col-6">
                        <a href="usuarios.php" class="premium-list-item d-flex flex-column align-items-center gap-2 p-3 border rounded-3 text-decoration-none transition">
                            <i class="bi bi-person-plus text-primary fs-3"></i>
                            <span class="small fw-semibold text-dark">Nuevo Usuario</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="productos.php" class="premium-list-item d-flex flex-column align-items-center gap-2 p-3 border rounded-3 text-decoration-none transition">
                            <i class="bi bi-box-seam text-success fs-3"></i>
                            <span class="small fw-semibold text-dark">Productos</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="categorias.php" class="premium-list-item d-flex flex-column align-items-center gap-2 p-3 border rounded-3 text-decoration-none transition">
                            <i class="bi bi-tags text-warning fs-3"></i>
                            <span class="small fw-semibold text-dark">Categorías</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="proveedores.php" class="premium-list-item d-flex flex-column align-items-center gap-2 p-3 border rounded-3 text-decoration-none transition">
                            <i class="bi bi-truck text-danger fs-3"></i>
                            <span class="small fw-semibold text-dark">Proveedores</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estado del Sistema -->
        <div class="col-12 col-lg-6">
            <div class="card border-0 rounded-4 shadow-sm p-4 bg-white">
                <h3 class="h5 fw-bold text-dark mb-4" style="font-family: var(--font-heading);">Estado del Sistema</h3>
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3">
                        <div class="d-flex align-items-center gap-3">
                            <span class="rounded-circle bg-success d-inline-block" style="width: 10px; height: 10px; box-shadow: 0 0 8px var(--primary-glow);"></span>
                            <span class="fw-semibold text-dark small">Base de Datos</span>
                        </div>
                        <span class="badge bg-success-subtle text-success border border-success border-opacity-10 fw-bold px-2.5 py-1.5" style="font-size: 0.75rem;">CONECTADO</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-clock text-muted"></i>
                            <span class="fw-semibold text-dark small">Hora del Servidor</span>
                        </div>
                        <span class="text-muted small"><?= date('H:i:s d/m/Y') ?></span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-shield-lock text-muted"></i>
                            <span class="fw-semibold text-dark small">Nivel de Acceso</span>
                        </div>
                        <span class="badge bg-primary-subtle text-primary border border-primary border-opacity-10 fw-bold px-2.5 py-1.5" style="font-size: 0.75rem;">ADMINISTRADOR</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>