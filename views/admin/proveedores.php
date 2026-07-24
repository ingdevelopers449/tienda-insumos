<?php
session_start();

if (!isset($_SESSION['usuario']) || ($_SESSION['usuario']['id_rol'] != 1 && $_SESSION['usuario']['id_rol'] !== '1')) {
    header('Location: ../../views/auth/login.php');
    exit;
}

require_once __DIR__ . '/../../config/database.php';
global $conn;

// Obtener proveedores
$query = "SELECT id_proveedor, nit, razon_social, direccion, telefono, email, estado FROM proveedores";
$result = $conn->query($query);
$proveedores = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $proveedores[] = $row;
    }
}

$titulo = 'Gestión de Proveedores';
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/sidebaradmin.php';
?>

<div class="container-fluid py-2">
    <div class="row g-4">
        <!-- Main Card: Providers List -->
        <div class="col-12">
            <div class="card border-0 rounded-4 shadow-sm p-4 bg-white">
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
                    <div>
                        <h2 class="h3 fw-bold text-dark mb-1" style="font-family: var(--font-heading);">
                            <span class="text-success">Gestión</span> de Proveedores
                        </h2>
                        <p class="text-muted small mb-0">Administra los proveedores de insumos agrícolas registrados en el sistema.</p>
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrearProveedor">
                        <i class="fa-solid fa-plus me-2"></i>Agregar Proveedor
                    </button>
                </div>

                <?php if (isset($_SESSION['alert'])): ?>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: '<?= htmlspecialchars($_SESSION['alert']['icon']) ?>',
                                title: '<?= htmlspecialchars($_SESSION['alert']['title']) ?>',
                                text: '<?= htmlspecialchars($_SESSION['alert']['text']) ?>',
                                confirmButtonColor: '#10b981',
                                background: '#1e293b',
                                color: '#fff'
                            });
                        });
                    </script>
                    <?php unset($_SESSION['alert']); ?>
                <?php endif; ?>

                <!-- Table -->
                <div class="table-responsive mt-2">
                    <table id="proveedoresTable" class="table table-hover align-middle border-0">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0 px-4 py-3 text-muted small fw-bold text-uppercase">Id</th>
                                <th class="border-0 px-4 py-3 text-muted small fw-bold text-uppercase">NIT</th>
                                <th class="border-0 px-4 py-3 text-muted small fw-bold text-uppercase">Razon Social</th>
                                <th class="border-0 px-4 py-3 text-muted small fw-bold text-uppercase">Dirección</th>
                                <th class="border-0 px-4 py-3 text-muted small fw-bold text-uppercase">Teléfono</th>
                                <th class="border-0 px-4 py-3 text-muted small fw-bold text-uppercase">Email</th>
                                <th class="border-0 px-4 py-3 text-muted small fw-bold text-uppercase">Estado</th>
                                <th class="border-0 px-4 py-3 text-muted small fw-bold text-uppercase text-center">Editar</th>
                                <th class="border-0 px-4 py-3 text-muted small fw-bold text-uppercase text-center">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($proveedores as $proveedor): ?>
                            <tr>
                                <td class="px-4 py-3 fw-bold text-secondary">#<?= htmlspecialchars($proveedor['id_proveedor']) ?></td>
                                <td class="px-4 py-3 fw-semibold text-dark"><?= htmlspecialchars($proveedor['nit']) ?></td>
                                <td class="px-4 py-3"><?= htmlspecialchars($proveedor['razon_social']) ?></td>
                                <td class="px-4 py-3 text-muted"><?= htmlspecialchars($proveedor['direccion'] ?? '-') ?></td>
                                <td class="px-4 py-3 text-muted"><?= htmlspecialchars($proveedor['telefono'] ?? '-') ?></td>
                                <td class="px-4 py-3 text-muted"><?= htmlspecialchars($proveedor['email'] ?? '-') ?></td>
                                <td class="px-4 py-3">
                                    <?php if ($proveedor['estado'] == 1 || $proveedor['estado'] == '1'): ?>
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-10 px-2.5 py-1.5 fw-bold" style="font-size: 0.75rem;">ACTIVO</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-10 px-2.5 py-1.5 fw-bold" style="font-size: 0.75rem;">INACTIVO</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <button type="button" onclick='openEditModal(<?= htmlspecialchars(json_encode($proveedor), ENT_QUOTES, "UTF-8") ?>)' class="btn btn-outline-success btn-sm rounded-circle d-flex align-items-center justify-content-center border-0 mx-auto" style="width: 35px; height: 35px;" title="Editar">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <button type="button" class="btn btn-outline-danger btn-sm rounded-circle d-flex align-items-center justify-content-center border-0 mx-auto deletebtn" data-id="<?= $proveedor['id_proveedor'] ?>" style="width: 35px; height: 35px;" title="Eliminar">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Proveedor -->
<div class="modal fade" id="modalCrearProveedor" tabindex="-1" aria-labelledby="modalCrearProveedorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header border-bottom border-light p-4">
                <h5 class="modal-title fw-bold text-dark mb-0" id="modalCrearProveedorLabel" style="font-family: var(--font-heading);">
                    <i class="fa-solid fa-truck-fast text-success me-2"></i>Agregar Proveedor
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../../controllers/ProveedorController.php?accion=crear" method="POST" class="needs-validation" novalidate>
                <div class="modal-body p-4 d-flex flex-column gap-3">
                    <div>
                        <label class="form-label text-secondary small fw-bold">NIT *</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-id-card"></i></span>
                            <input type="text" name="nit" required class="form-control" placeholder="Ej: 123456789-0">
                        </div>
                    </div>
                    <div>
                        <label class="form-label text-secondary small fw-bold">Razón Social *</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-building"></i></span>
                            <input type="text" name="razon_social" required class="form-control" placeholder="Ej: Distribuidora Agrícola SAS">
                        </div>
                    </div>
                    <div>
                        <label class="form-label text-secondary small fw-bold">Dirección</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-location-dot"></i></span>
                            <input type="text" name="direccion" class="form-control" placeholder="Ej: Calle 26 # 45-12">
                        </div>
                    </div>
                    <div>
                        <label class="form-label text-secondary small fw-bold">Teléfono</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-phone"></i></span>
                            <input type="text" name="telefono" class="form-control" placeholder="Ej: 3001234567">
                        </div>
                    </div>
                    <div>
                        <label class="form-label text-secondary small fw-bold">Correo Electrónico</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="proveedor@empresa.com">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top border-light p-4">
                    <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-premium btn-premium-primary">Guardar Proveedor</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Proveedor -->
<div class="modal fade" id="modalEditarProveedor" tabindex="-1" aria-labelledby="modalEditarProveedorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header border-bottom border-light p-4">
                <h5 class="modal-title fw-bold text-dark mb-0" id="modalEditarProveedorLabel" style="font-family: var(--font-heading);">
                    <i class="fa-solid fa-building-circle-exclamation text-success me-2"></i>Editar Proveedor
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../../controllers/ProveedorController.php?accion=editar" method="POST" class="needs-validation" novalidate>
                <div class="modal-body p-4 d-flex flex-column gap-3">
                    <input type="hidden" name="id_proveedor" id="edit_id_proveedor">
                    <div>
                        <label class="form-label text-secondary small fw-bold">NIT *</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-id-card"></i></span>
                            <input type="text" name="nit" id="edit_nit" required class="form-control">
                        </div>
                    </div>
                    <div>
                        <label class="form-label text-secondary small fw-bold">Razón Social *</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-building"></i></span>
                            <input type="text" name="razon_social" id="edit_razon_social" required class="form-control">
                        </div>
                    </div>
                    <div>
                        <label class="form-label text-secondary small fw-bold">Dirección</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-location-dot"></i></span>
                            <input type="text" name="direccion" id="edit_direccion" class="form-control">
                        </div>
                    </div>
                    <div>
                        <label class="form-label text-secondary small fw-bold">Teléfono</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-phone"></i></span>
                            <input type="text" name="telefono" id="edit_telefono" class="form-control">
                        </div>
                    </div>
                    <div>
                        <label class="form-label text-secondary small fw-bold">Correo Electrónico</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-envelope"></i></span>
                            <input type="email" name="email" id="edit_email" class="form-control">
                        </div>
                    </div>
                    <div>
                        <label class="form-label text-secondary small fw-bold">Estado *</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-toggle-on"></i></span>
                            <select name="estado" id="edit_estado" required class="form-select bg-white">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top border-light p-4">
                    <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-premium btn-premium-primary">Actualizar Proveedor</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Eliminar Proveedor -->
<div class="modal fade" id="eliminarProveedor" tabindex="-1" aria-labelledby="eliminarProveedorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header border-bottom border-light p-4">
                <h5 class="modal-title fw-bold text-dark" id="eliminarProveedorLabel">
                    <i class="fa-solid fa-triangle-exclamation text-danger me-2"></i>Confirmar Acción
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <p class="mb-0">¿Estás seguro de que deseas eliminar este proveedor? Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer border-top border-light p-4">
                <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Cancelar</button>
                <a href="#" id="btnConfirmarEliminarProveedor" class="btn btn-danger px-4 py-2">Eliminar</a>
            </div>
        </div>
    </div>
</div>

<script>
    function openEditModal(proveedor) {
        document.getElementById('edit_id_proveedor').value = proveedor.id_proveedor;
        document.getElementById('edit_nit').value = proveedor.nit;
        document.getElementById('edit_razon_social').value = proveedor.razon_social;
        document.getElementById('edit_direccion').value = proveedor.direccion || '';
        document.getElementById('edit_telefono').value = proveedor.telefono || '';
        document.getElementById('edit_email').value = proveedor.email || '';
        document.getElementById('edit_estado').value = proveedor.estado;
        
        var editModal = new bootstrap.Modal(document.getElementById('modalEditarProveedor'));
        editModal.show();
    }

    // Validación Bootstrap
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>

<!-- JQuery & DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

<script>
    $(document).ready(function() {
        $('#proveedoresTable').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
            },
            responsive: true,
            pageLength: 10,
            columnDefs: [
                { orderable: false, targets: [7, 8] }
            ]
        });

        // Trigger dynamic delete modal
        $(document).on('click', '.deletebtn', function() {
            var id = $(this).data('id');
            $('#btnConfirmarEliminarProveedor').attr('href', '../../controllers/ProveedorController.php?accion=eliminar&id=' + id);
            var delModal = new bootstrap.Modal(document.getElementById('eliminarProveedor'));
            delModal.show();
        });
    });
</script>

<style>
    /* Styling DataTables to look sleek and match premium design */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0 !important;
        margin: 0 2px !important;
        border: none !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: none !important;
        border: none !important;
    }
    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        padding: 6px 12px;
        outline: none;
    }
    .dataTables_wrapper .dataTables_length select:focus,
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-glow);
    }
    .page-item.active .page-link {
        background-color: var(--primary) !important;
        border-color: var(--primary) !important;
        color: #fff !important;
    }
    .page-link {
        color: var(--primary) !important;
        border-radius: 6px;
    }
</style>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
